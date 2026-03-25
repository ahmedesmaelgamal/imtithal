<?php


/**
 * Summary of namespace App\Services
 */

namespace App\Services;

use App\Traits\FirebaseNotification;
use App\Traits\PhotoTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * Class BaseService
 * Provides common functionalities to be used by other service classes.
 */
abstract class BaseService
{
    use PhotoTrait;
    use FirebaseNotification;

    /**
     * @var Model The model to be used by the service.
     */
    public Model $model;

    /**
     * BaseService constructor.
     * @param Model $model The model to be used by the service.
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all instances of the model.
     *
     * @return Collection
     */
    public function getAll(): Collection
    {
        return $this->model->all();
    }

    /**
     * Get the latest instances of the model for DataTable.
     *
     * @return mixed
     */
    public function getDataTable(): mixed
    {
        return $this->model->latest()->get();
    }

    /**
     * Generate the status toggle HTML for DataTable.
     *
     * @param mixed $obj
     * @return string
     */
    public function statusDatatable($obj): string
    {
        return '
                    <div class="form-check form-switch">
                       <input style="margin-left: 0px;" class="tgl tgl-ios statusBtn form-check-input" data-id="' . $obj->id . '" name="statusBtn" id="statusUser-' . $obj->id . '" type="checkbox" ' . ($obj->status == 1 ? 'checked' : '') . '/>
                       <label class="tgl-btn" dir="ltr" for="statusUser-' . $obj->id . '"></label>
                    </div>';
    }

    /**
     * Get all instances of the model that match the given conditions.
     *
     * @param array $conditions
     * @return Collection
     */
    public function getWhere(array $conditions): Collection
    {
        $query = $this->model->query();

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                $query->where($field, $value[0], $value[1]);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->get();
    }

    /**
     * Get the first instance of the model that matches the given conditions.
     *
     * @param array $conditions
     * @return Model|null
     */
    public function firstWhere(array $conditions): ?Model
    {
        $query = $this->model->query();

        foreach ($conditions as $field => $value) {
            if (is_array($value)) {
                $query->where($field, $value[0], $value[1]);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->first();
    }

    /**
     * Get a single instance of the model by ID.
     *
     * @param int $id
     * @return Model|null
     */
    public function getById(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Get all active instances of the model based on the given column.
     *
     * @param mixed $column
     * @return Collection<int, TModel>
     */
    public function getActive($column)
    {
        return $this->model->where($column, 1)->get();
    }

    /**
     * Handle file upload and save the image.
     *
     * @param mixed $file
     * @param mixed $folder
     * @param mixed $type
     * @return string
     */
    public function handleFile($file, $folder = null, $type = 'image'): string
    {
        return $this->saveImage($file, $folder, $type);
    }

    /**
     * Handle multiple file uploads and save the images.
     *
     * @param mixed $files
     * @param mixed $folder
     * @return string[]
     */
    public function handleFiles($files, $folder = null): array
    {
        $data = [];
        foreach ($files as $file) {
            $data[] = $this->saveImage($file, $folder);
        }

        return $data;
    }

    /**
     * Get authenticated user's data for DataTable based on the given column and guard.
     *
     * @param mixed $column
     * @param mixed $guard
     * @return Collection<int, TModel>
     */
    public function getAuthDateTable($column, $guard): mixed
    {
        return $this->model->where($column, auth($guard)->user()->id)->get();
    }

    /**
     * Create a new instance of the model.
     *
     * @param array $data
     * @return JsonResponse
     */
    public function createData(array $data): JsonResponse
    {
        return $this->model->create($data);
    }

    /**
     * Upload an image to the specified folder.
     *
     * @param mixed $image
     * @param mixed $folder
     * @return string
     */
    public function uploadImage($image, $folder = null): string
    {
        return $image->store('uploads/ ' . $folder, 'public');
    }

    /**
     * Update an existing instance of the model.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function updateData(int $id, array $data): bool
    {
        $model = $this->getById($id);
        return $model->update($data);
    }

    /**
     * Delete an instance of the model by ID and its associated files.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $model = $this->getById($id);
        if ($model) {
            // Check and delete any associated files
            if (isset($model->image)) {
                $this->deleteFile($model->image);
            }
            if (isset($model->breadcrumb)) {
                $this->deleteFile($model->breadcrumb);
            }
            if (isset($model->not_found_icon)) {
                $this->deleteFile($model->not_found_icon);
            }

            // Proceed with model deletion
            $model->delete();

            return response()->json(['status' => 200, 'message' => 'تم الحذف بنجاح']);
        }
        return response()->json(['status' => 405, 'message' => 'حدث خطأ ما']);
    }

    public function deleteForBlade(int $id)
    {
        $model = $this->getById($id);
        if ($model) {
            // Check and delete any associated files
            if (isset($model->image)) {
                $this->deleteFile($model->image);
            }
            if (isset($model->breadcrumb)) {
                $this->deleteFile($model->breadcrumb);
            }
            if (isset($model->not_found_icon)) {
                $this->deleteFile($model->not_found_icon);
            }

            // Proceed with model deletion
            $model->delete();

            return  true;

        }
        return false;
    }

    /**
     * Change the status of an instance of the model.
     *
     * @param mixed $request
     * @return JsonResponse|mixed
     */
    public function changeStatus($request)
    {
        $obj = $this->getById($request->id);

        if ($obj) {
            $obj->status = $obj->status == 1 ? 0 : 1;

            $obj->save();
            return response()->json(['status' => 200]);
        }

        return response()->json(['status' => 405]);
    }

    /**
     * Update a specific column of an instance of the model.
     *
     * @param mixed $id
     * @param mixed $column
     * @param mixed $value
     * @return bool
     */
    public function updateColumn($id, $column, $value = null): bool
    {
        $obj = $this->getById($id);
        if ($value) {
            $obj->{$column} = $value;
            $obj->save();
            return true;
        } else {
            $obj->{$column} = !$obj->{$column};
            $obj->save();
            return true;
        }
    }

    /**
     * Delete files associated with the model.
     *
     * @param Model $model
     * @return void
     */
    protected function deleteAssociatedFiles(Model $model): void
    {
        // Check and delete single image or file
        if (!empty($model->image)) {
            $this->deleteFile($model->image);
        }

        // Check and delete multiple images or files
        $fields = ['images', 'files']; // Adjust according to your model's fields
        foreach ($fields as $field) {
            if (!empty($model->{$field})) {
                foreach ($model->{$field} as $file) {
                    $this->deleteFile($file);
                }
            }
        }
    }

    /**
     * Helper function to delete a file from storage.
     *
     * @param string $filePath
     * @return void
     */
    protected function deleteFile(string $filePath): void
    {
        if (File::exists(public_path($filePath))) {
            File::delete(public_path($filePath));
        }
    }

    /**
     * Get a pluck array from the model based on specified key and value.
     *
     * @param string $keyField The attribute to use as the key.
     * @param string $valueField The attribute to use as the value.
     * @return array
     */
    public function getPluckArray(string $keyField, string $valueField): array
    {
        return $this->model->pluck($valueField, $keyField)->toArray();
    }

    /**
     * Generate the image HTML for DataTable.
     *
     * @param mixed $image
     * @return string
     */
    public function imageDataTable($image): string
    {
        if ($image)
            return '<img src="' . asset($image) . '" onclick="window.open(' . "'" . asset($image) . "'" . ')" class="avatar avatar-md rounded-circle" style="cursor:pointer;" width="100" height="100">';
        else
            $image = asset('assets/uploads/empty.png');
        return '<img src="' . asset($image) . '" onclick="window.open(' . "'" . asset($image) . "'" . ')" class="avatar avatar-md rounded-circle" style="cursor:pointer;" width="100" height="100">';
    }

    /**
     * Validate API request data based on the given rules.
     *
     * @param mixed $request
     * @param mixed $rules
     * @return false|JsonResponse
     */
    public function apiValidator($request, $rules, $messages = []): false|JsonResponse
    {
        $validator = Validator::make($request, $rules, $messages);

        if ($validator->fails()) {
            return $this->responseMsg($validator->errors()->first(), null, 422);
        }

        return false;
    }

    /**
     * Generate a JSON response message.
     *
     * @param mixed $msg
     * @param mixed $data
     * @param int $status
     * @return JsonResponse
     */
    public function responseMsg($msg, $data = null, int $status = 200): JsonResponse
    {
        return response()->json([
            'msg' => $msg,
            'data' => $data,
            'status' => $status
        ]);
    }

    /**
     * Generate a unique code.
     *
     * @return string
     */
    protected function generateCode(): string
    {
        do {
            $code = random_int(10000000000, 99999999999);
        } while ($this->firstWhere(['code' => $code]));

        return $code;
    }

    /**
     * Execute a callback function within a try-catch block.
     *
     * @param mixed $callback
     * @return mixed
     */
    public function useTryAndCatch($callback)
    {
        try {
            return $callback();
        } catch (\Exception $e) {
            return $this->responseMsg($e->getMessage(), null, 500);
        }
    }

    /**
     * Generate a one-time password (OTP) of the specified length.
     *
     * @param mixed $qty
     * @return int
     */
    public function generateOtp($qty = 6): int
    {
        return random_int(pow(10, $qty - 1), pow(10, $qty) - 1);
    }

    /**
     * Update an environment variable in the .env file.
     *
     * @param mixed $key
     * @param mixed $value
     * @return void
     */
    protected function updateEnvVariable($key, $value): void
    {
        $path = base_path('.env');

        if (file_exists($path)) {
            // Read the .env file content
            $envContent = file_get_contents($path);

            // Find the variable in the .env file or add it if it doesn’t exist
            if (strpos($envContent, "{$key}=") !== false) {
                // Replace the value of the existing key
                $envContent = preg_replace("/^{$key}=.*/m", "{$key}={$value}", $envContent);
            } else {
                // Append new variable to the end of .env file
                $envContent .= "\n{$key}={$value}";
            }

            // Write the updated content back to the .env file
            file_put_contents($path, $envContent);
        }
    }

    /**
     * Delete selected instances of the model based on the given request.
     *
     * @param mixed $request
     * @return JsonResponse|mixed
     */
    public function deleteSelected($request)
    {
        try {
            $ids = $request->input('ids');
            if (is_array($ids) && count($ids)) {
                $this->model->whereIn('id', $ids)->delete();
                return response()->json(['status' => 200, 'message' => trns('deleted_successfully')]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => trns('something_went_wrong')]);
        }
    }

    /**
     * Update a specific column for selected instances of the model based on the given request.
     *
     * @param mixed $request
     * @param mixed $column
     * @return JsonResponse|mixed
     */
    public function updateColumnSelected($request, $column)
    {
        try {
            $ids = $request->input('ids');
            if (is_array($ids) && count($ids)) {
                foreach ($ids as $id) {
                    $obj = $this->getById($id);
                    $obj->{$column} = !$obj->{$column};
                    $obj->save();
                }
                return response()->json(['status' => 200, 'message' => trns('updated_successfully')]);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => trns('something_went_wrong')]);
        }
    }

    /**
     * Generate a username based on the given name.
     *
     * @param mixed $name
     * @return string
     */
    public function generateUsername($name): string
    {
        return str_replace(' ', '', strtolower($name)) . rand(1000, 9999);
    }


    /**
     * @param $data
     * @return JsonResponse
     */
    public function successResponse($data = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'msg' => 'تم جلب البيانات بنجاح',
            'status' => 200
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function errorResponse($data = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'msg' => 'حدث خطأ ما',
            'status' => 500
        ]);
    }

    /**
     * @param $data
     * @return JsonResponse
     */
    public function validationResponse($data = null): JsonResponse
    {
        return response()->json([
            'data' => $data,
            'msg' => trns('validation_error'),
            'status' => 422
        ]);
    }
}
