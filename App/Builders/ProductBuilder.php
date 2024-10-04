<?php

namespace App\Builders;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class ProductBuilder extends Builder
{
    public function wherePublished(): self
    {
        return $this->where('publish_at', '<=', now());
    }

    public function whereOwner(User $user): self
    {
        return $this->where('owner_id', $user->id);
    }

    public function wherePriceBetween(float $from, float $to): self
    {
        return $this->whereBetween('price', [$from, $to]);
    }

    public function whereContains(string $searchTerm): self
    {
        return $this->where(function ($query) use ($searchTerm) {
            $query->where('title', 'LIKE', "%$searchTerm%")
                ->orWhere('description', 'LIKE', "%$searchTerm%");
        });
    }

    public function orderByRatings(): self
    {
        return $this->withAvg('ratings as average_rating', 'rating')
            ->orderByDesc('average_rating');
    }

    public function mostPopular(int $count): self
    {
        return $this->orderByRatings()
            ->take($count);
    }

    public function publish(): self
    {
        $this->model->publish_at = now();
        $this->model->save();

        return $this;
    }

    public function publishAll(): self
    {
        $this->whereNotPublished()
            ->update(['publish_at' => now()]);

        return $this;
    }

    protected function whereNotPublished(): self
    {
        return $this->where('publish_at', '>', now());
    }
}
