<?php

namespace Modules\ParcelManagement\Service;

use App\Service\BaseService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Modules\ParcelManagement\Repository\ParcelWeightRepositoryInterface;
use Modules\ParcelManagement\Service\Interface\ParcelWeightServiceInterface;

class ParcelWeightService extends BaseService implements ParcelWeightServiceInterface
{
    protected $parcelWeightRepository;
    public function __construct(ParcelWeightRepositoryInterface $parcelWeightRepository)
    {
        parent::__construct($parcelWeightRepository);
        $this->parcelWeightRepository = $parcelWeightRepository;
    }

    public function index(array $criteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): Collection|LengthAwarePaginator
    {

        $data = [];
        if (array_key_exists('status', $criteria) && $criteria['status'] !== 'all') {
            $data['is_active'] = $criteria['status'] == 'active' ? 1 : 0;
        }

        $searchData = [];
        if (array_key_exists('search', $criteria) && $criteria['search'] != '') {
            $searchData['fields'] = ['min_weight', 'max_weight'];
            $searchData['value'] = $criteria['search'];
        }
        $whereInCriteria = [];
        $whereBetweenCriteria = [];
        $whereHasRelations = [];
        return $this->baseRepository->getBy(criteria: $data, searchCriteria: $searchData, whereInCriteria: $whereInCriteria, whereBetweenCriteria: $whereBetweenCriteria, whereHasRelations: $whereHasRelations, relations: $relations, orderBy: $orderBy, limit: $limit, offset: $offset, withCountQuery: $withCountQuery); // TODO: Change the autogenerated stub
    }
    public function create(array $data): ?Model
    {
        $storeData = [
            'min_weight'=>$data['min_weight'],
            'max_weight'=>$data['max_weight'],
        ];
        return $this->parcelWeightRepository->create(data: $storeData);
    }

    public function update(string|int $id, array $data = []): ?Model
    {
        $model = $this->findOne(id: $id);
        $updateData = [
            'min_weight'=>$data['min_weight'],
            'max_weight'=>$data['max_weight'],
        ];
        return $this->parcelWeightRepository->update($id, $updateData);
    }

    public function export(array $criteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, bool $onlyTrashed = false, bool $withTrashed = false): Collection|LengthAwarePaginator|\Illuminate\Support\Collection
    {
        return $this->index(criteria: $criteria, orderBy: $orderBy)->map(function ($item) {
            return [
                'Id' => $item['id'],
                'Min Weight' => $item['min_weight'] . ' Kg',
                'Max Weight' => $item['max_weight'] . ' Kg',
                'Weight Range' => $item['min_weight'] . '-' . $item['max_weight'] . 'Kg',
                'Status' => $item['is_active'] ? 'Active' : 'Inactive',
            ];
        });
    }


    public function trashedData(array $criteria = [], array $relations = [], array $orderBy = [], int $limit = null, int $offset = null, array $withCountQuery = []): Collection|LengthAwarePaginator
    {
        $searchData = [];
        if (array_key_exists('search', $criteria) && $criteria['search'] != '') {
            $searchData['fields'] = ['min_weight','max_weight'];
            $searchData['value'] = $criteria['search'];
        }
        return $this->baseRepository->getBy(searchCriteria: $searchData, relations: $relations, orderBy: $orderBy, limit: $limit, offset: $offset, onlyTrashed: true, withCountQuery: $withCountQuery);
    }
}
