<?php

namespace Coupons\Services;

use Coupons\Repositories\RoleRepository;
use Coupons\Repositories\CouponRepository;

class CouponService
{
    /**
     * The repository that will be used.
     *
     * @var CouponRepository
     */
    private $repository;

    /**
     * Constructor.
     *
     * @param CouponRepository $repository
     */
    public function __construct(CouponRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Get coupons collection.
     *
     * @param  int|null $count
     * @return Collection
     */
    public function get($count = null)
    {
        if ($count != null) {
            return $this->repository->getAllCouponsPaginated($count);
        }

        return $this->repository->getAllCoupons();
    }

    /**
     * Find record.
     *
     * @param  int $id
     * @return Coupon|null
     */
    public function find($id)
    {
        return $this->repository->find($id);
    }

    /**
     * Store new record.
     *
     * @param  array $data
     * @return Coupon
     */
    public function store($data)
    {
        return $this->repository->create($data);;
    }

    /**
     * Updae the given record.
     *
     * @param  array $data
     * @param  Coupon $coupon
     * @return bool
     */
    public function update($data, $coupon)
    {
        return $this->repository->update($data, $coupon);
    }

    /**
     * Delete an existing record.
     *
     * @param  int $id
     * @return bool
     */
    public function delete($id)
    {
        $coupon = $this->find($id);

        return $this->repository->delete($coupon);
    }
}