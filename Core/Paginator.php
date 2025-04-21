<?php

namespace Core;

class Paginator
{
  public int $currentPage;
  public int $perPage;
  public int $totalItems;
  public int $totalPages;

  public function __construct(int $currentPage, int $perPage, int $totalItems)
  {
    $this->currentPage = max(1, $currentPage);
    $this->perPage = $perPage;
    $this->totalItems = $totalItems;
    $this->totalPages = (int) ceil($totalItems / $perPage);
  }

  public function offset(): int
  {
    return ($this->currentPage - 1) * $this->perPage;
  }

  public function hasPrev(): bool
  {
    return $this->currentPage > 1;
  }

  public function hasNext(): bool
  {
    return $this->currentPage < $this->totalPages;
  }

  public function pages(int $maxVisible = 5): array
  {
    $start = max(1, $this->currentPage - floor($maxVisible / 2));
    $end = min($start + $maxVisible - 1, $this->totalPages);

    if ($end - $start + 1 < $maxVisible)
    {
      $start = max(1, $end - $maxVisible + 1);
    }
    return range($start, $end);
  }
}