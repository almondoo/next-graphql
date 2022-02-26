<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand as Command;
use Illuminate\Support\Str;

class UseCaseMakeCommand extends Command
{
    private const MAINNAME = 'UseCase';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:usecase {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'infrastructure用のusecaseファイルを生成';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'UseCase';

    /**
     * 生成に使うスタブファイルを取得する
     *
     * @return string
     */
    protected function getStub()
    {
        return __DIR__ . '/stubs/usecase.stub';
    }

    /**
     * クラスのデフォルトの名前空間を取得する
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\UseCases';
    }

    /**
     * Get the destination class path.
     *
     * @param  string  $name
     * @return string
     */
    protected function getPath($name)
    {
        $name = Str::replaceFirst($this->rootNamespace(), '', $name);
        return $this->laravel['path'] . '/' . str_replace('\\', '/', $name) . self::MAINNAME . '.php';
    }
}
