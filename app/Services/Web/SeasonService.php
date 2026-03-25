<?php

namespace App\Services\Web;

use App\Models\Season as ObjModel;

use App\Services\BaseService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeasonService extends BaseService
{


    public function __construct(
        protected ObjModel $objModel,
    )
    {
        parent::__construct($objModel);
    }

    public function index()
    {

        $seasons = $this->objModel->select('id', 'name', 'database_name', 'is_active')
            ->orderBy('id', 'desc')
            ->get();
        return view('web.seasons.index', compact('seasons'));
    }

    public function store($request)
    {
        $dbName = $request->database_name;

        try {
            $this->createDatabase($dbName);
            $this->configureTempConnection($dbName);
            $this->importSqlFileToTempDb('example_database.sql');
            $this->createSeasonAndSetActive($request->name, $dbName);
            $this->syncSeasonsTableToTempDb();
            $this->updateEnv(['DB_DATABASE' => $dbName]);
            Artisan::call('config:clear');


            return $this->responseMsg('تم إنشاء الموسم بنجاح', null, 200);

        } catch (\Exception $e) {

            $errorMessage = $e->getMessage();
            return $this->responseMsg('حدث خطأ أثناء إنشاء الموسم: ' . $errorMessage, null, 500);
        }
    }

    protected function createDatabase($dbName)
    {
        DB::statement("CREATE DATABASE `$dbName` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    }

    protected function configureTempConnection($dbName)
    {
        config(['database.connections.temp' => [
            'driver' => env('DB_CONNECTION', 'mysql'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => $dbName,
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'strict' => true,
            'engine' => null,
        ]]);
    }

    protected function importSqlFileToTempDb($sqlFileName)
    {
        $sqlFilePath = public_path($sqlFileName);
        $sqlContent = file_get_contents($sqlFilePath);
        $statements = array_filter(array_map('trim', explode(';', $sqlContent)));

        foreach ($statements as $statement) {
            if (!empty($statement)) {
                DB::connection('temp')->unprepared($statement . ';');
                usleep(100000);
            }
        }
    }

    protected function createSeasonAndSetActive($name, $dbName)
    {
        $newSeason = $this->model->create([
            'name' => $name,
            'database_name' => $dbName,
            'is_active' => 1
        ]);
        $this->model->where('id', '!=', $newSeason->id)->update(['is_active' => 0]);
    }

    protected function syncSeasonsTableToTempDb()
    {
        $seasonsData = DB::table('seasons')->get();
        DB::connection('temp')->table('seasons')->truncate();

        foreach ($seasonsData as $season) {
            $data = (array)$season;
            unset($data['id']);
            DB::connection('temp')->table('seasons')->insert($data);
        }
    }

    protected function updateEnv(array $data)
    {
        $envPath = base_path('.env');

        if (!File::exists($envPath)) {
            return false;
        }

        $envContent = File::get($envPath);

        foreach ($data as $key => $value) {
            $pattern = "/^$key=.*$/m";
            $replacement = "$key=$value";

            if (preg_match($pattern, $envContent)) {
                $envContent = preg_replace($pattern, $replacement, $envContent);
            } else {
                $envContent .= "\n$replacement";
            }
        }

        File::put($envPath, $envContent);

        return true;
    }

}
