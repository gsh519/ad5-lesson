<?php

declare(strict_types=1);

class Paginate
{
    private const DEFAULT_PER_PAGE = 5;

    /**
     * ページ総件数
     *
     * @var integer
     */
    private int $total_page_number;

    /**
     * ◯ - △ 件目の◯
     *
     * @var integer
     */
    private int $from;

    /**
     * ◯ - △ 件目の△
     *
     * @var integer
     */
    private int $to;

    /**
     * ページネーション表示範囲
     *
     * @var integer
     */
    private int $range;

    /**
     * クエリパラメータ
     *
     * @var array
     */
    private array $query_parametor;

    public function __construct(
        private int $total_count,
        private int $page,
    ) {
        // 社員総件数
        $this->setTotalCount($this->total_count);
        // ページ数
        $this->setTotalPageNumber((int)ceil($this->getTotalCount() / self::DEFAULT_PER_PAGE));
        $offset = ($this->page - 1) * self::DEFAULT_PER_PAGE;
        // from, to
        $this->setFrom($offset + 1);
        $this->setTo($this->page * self::DEFAULT_PER_PAGE);

        // ページネーション表示範囲
        if ($this->page === 1 || $this->page === $this->getTotalPageNumber()) {
            $this->setRange(4);
        } elseif ($this->page === 2 || ($this->page === $this->getTotalPageNumber() - 1)) {
            $this->setRange(3);
        } else {
            $this->setRange(2);
        }
    }

    /**
     * データ総件数getter
     *
     * @return integer
     */
    public function getTotalCount(): int
    {
        return $this->total_count;
    }

    /**
     * データ総件数setter
     *
     * @param integer $total_count
     * @return void
     */
    public function setTotalCount(int $total_count): void
    {
        $this->total_count = $total_count;
    }

    /**
     * ページ総件数getter
     *
     * @return integer
     */
    public function getTotalPageNumber(): int
    {
        return $this->total_page_number;
    }

    /**
     * ページ総件数setter
     *
     * @param integer $total_page_number
     * @return integer
     */
    public function setTotalPageNumber(int $total_page_number): void
    {
        $this->total_page_number = $total_page_number;
    }

    /**
     * 表示from getter
     *
     * @return integer
     */
    public function getFrom(): int
    {
        return $this->from;
    }

    /**
     * 表示from setter
     *
     * @property int $from
     * @return integer
     */
    public function setFrom(int $from): void
    {
        $this->from = $from;
    }

    /**
     * 表示to getter
     *
     * @return integer
     */
    public function getTo(): int
    {
        return $this->to;
    }

    /**
     * 表示to setter
     *
     * @property int $from
     * @return integer
     */
    public function setTo(int $to): void
    {
        if ($to > $this->getTotalCount()) {
            $this->to = $this->getTotalCount();
            return;
        }

        $this->to = $to;
    }

    /**
     * 表示範囲getter
     *
     * @return integer
     */
    public function getRange(): int
    {
        return $this->range;
    }

    /**
     * 表示範囲setter
     *
     * @param integer $range
     * @return void
     */
    public function setRange(int $range): void
    {
        $this->range = $range;
    }

    /**
     * ページネーション取得件数
     *
     * @return integer
     */
    public function getDefaultPerPage(): int
    {
        return self::DEFAULT_PER_PAGE;
    }

    /**
     * 現在ページ数
     *
     * @return integer
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * クエリパラメータgetter
     *
     * @return array
     */
    public function getQueryParametor(): array
    {
        return $this->query_parametor;
    }

    /**
     * クエリパラメータsetter
     *
     * @param array $query_parametor
     * @return void
     */
    public function setQueryParametor(array $query_parametor): void
    {
        $this->query_parametor = $query_parametor;
    }

    /**
     * 前へページリンク
     *
     * @return string
     */
    public function prev(): string
    {
        $prev = $this->getPage() - 1;
        if (empty($this->getQueryParametor())) {
            return "?page={$prev}";
        }

        $parametor = http_build_query($this->getQueryParametor());
        return "?page={$prev}&{$parametor}";
    }

    /**
     * 次へページリンク
     *
     * @return string
     */
    public function next(): string
    {
        $next = $this->getPage() + 1;
        if (empty($this->getQueryParametor())) {
            return "?page={$next}";
        }

        $parametor = http_build_query($this->getQueryParametor());
        return "?page={$next}&{$parametor}";
    }

    /**
     * ページリンク
     *
     * @return string
     */
    public function link(int $i): string
    {
        if (empty($this->getQueryParametor())) {
            return "?page={$i}";
        }

        $parametor = http_build_query($this->getQueryParametor());
        return "?page={$i}&{$parametor}";
    }
}
