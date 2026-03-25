<?php

namespace App\Http\DataTables;

use App\Enum\PermissionEnum;
use Spatie\Permission\Models\Role as ObjModel;
use App\Services\Web\RoleService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    public function __construct(
        protected ObjModel    $objModel,
        protected RoleService $roleService
    )
    {
        parent::__construct($objModel);
    }

    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('name', function ($query) {
                return $query->name;
            })
            ->addColumn('permissions_count', function ($query) {
                if ($query->guard_name == 'web') {
                    $permissionsList = implode('&#10;', $query->permissions->pluck('name')->toArray());
                    $permissionLangList = [];
                    foreach ($query->permissions->pluck('name')->toArray() as $permission) {
                        $permissionLangList[] = PermissionEnum::from($permission)->lang();
                    }
                    $permissionLangList = implode('&#10;', $permissionLangList);
                    return '<span class="btn main-button" title="' . $permissionLangList . '">' . $query->permissions->count() . '</span>';
                }
                return 'دور أساسي';
            })
            ->editColumn('created_at', function ($query) {
                return \Carbon\Carbon::parse($query->created_at)->locale('ar')->translatedFormat('d F Y');
            })
            ->addColumn('actions', function ($query) {
                if ($query->guard_name == 'web') {
                    //test
                    return '
                            <button class="view border-0 edit"
                                data-bs-toggle="modal"
                                data-permissions=\'' . json_encode($query->permissions->pluck('name')->toArray(), JSON_HEX_APOS | JSON_HEX_QUOT) . '\'
                                data-id="' . $query->id . '"
                                data-name="' . htmlspecialchars($query->name, ENT_QUOTES, 'UTF-8') . '">
                                <img class="h-24" src="' . asset('web/image/edit-icon.png') . '" alt="no-image">
                                تعديل
                            </button>
                        ';
                }

                return '
                            <button class="view border-0">
                                لا يمكن التعديل
                            </button>';
            })
            ->
            rawColumns(['name', 'permissions_count', 'actions', 'created_at']);
    }

    public function query(ObjModel $model): QueryBuilder
    {
        return $model->newQuery()->with('permissions')->orderBy('created_at', 'desc');
    }


}
