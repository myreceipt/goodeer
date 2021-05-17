<?php
namespace IT;

/**
 * Simple paginator class
 * @package IT\Paginator
 * @author JuicyCodes
 * @version 1.0.3
 * @created 01-04-2017 10:55 PM
 * @modified 17-04-2017 02:27 AM
 */
class Paginator
{
    public $limit = "15";

    /**
     * Set some startup variables
     */
    public function __construct()
    {
        global $var;
        if (empty($var->get->page)) {
            $this->page = '1';
        } else {
            $this->page = $var->get->page;
        }
        $this->start = (($this->page - 1) * $this->limit);
    }

    /**
     * Set per page item limit
     * @param  int $limit
     */
    public function limit($limit)
    {
        $this->limit = $limit;
        $this->start = (($this->page - 1) * $this->limit);
    }

    /**
     * Show paging
     * @param  int $total
     * @param  int $page
     * @param  string $link
     * @return string
     */
    public function show($total, $page, $link = "?page=")
    {
        if (!empty($_GET)) {
            $_GET["page"] = "";
            $link         = "?" . http_build_query($_GET);
        }
        $max_pages = ceil($total / $this->limit);
        $page      = ($page > $max_pages ? $max_pages : $page);
        $page      = $page > 0 ? $page : "1";
        $prev_page = ($page - 1);
        $next_page = ($page + 1);

        $start = ($page - 5 > 0 ? ($page - 5) : "1");
        $end   = ($page + 5 < $max_pages ? ($page + 5) : $max_pages);

        $html .= '<ul class="pagination no-margins">';

        if ($prev_page > 0) {
            $html .= '<li><a href="' . $link . $prev_page . '">Prev</a></li>';
        } else {
            $html .= '<li class="disabled"><a href="#">Prev</a></li>';
        }

        if ($start > 1) {
            $html .= '<li><a href="' . $link . '1' . '">1</a>';
            $html .= '<li class="disabled"><a href="#">...</a></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $html .= '<li class="' . ($i == $page ? 'active' : '') . '"><a href="' . $link . $i . '">' . $i . '</a></li>';
        }

        if ($end < $max_pages) {
            $html .= '<li class="disabled"><a href="#">...</a></li>';
            $html .= '<li><a href="' . $link . $max_pages . '">' . $max_pages . '</a>';
        }

        if ($next_page <= $max_pages) {
            $html .= '<li><a href="' . $link . $next_page . '">Next</a></li>';
        } else {
            $html .= '<li class="disabled"><a href="#">Next</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }
}
