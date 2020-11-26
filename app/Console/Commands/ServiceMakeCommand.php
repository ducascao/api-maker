<?php
namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class ServiceMakeCommand extends GeneratorCommand
{
    /**
     * O nome e a assinatura do comando do console.
     *
     * @var string
     */
    protected $name = 'make:service';
  
    /**
      * A descrição do comando do console.
      *
      * @var string
      */
    protected $description = 'Create a new service class';
  
    /**
   * O tipo de classe sendo gerada.
   *
   * @var string
   */
    protected $type = 'Service';
   
    /**
    * Substitui o nome da classe para o stub fornecido.
    *
    * @param  string  $stub
    * @param  string  $name
    * @return string
    */
    protected function replaceClass($stub, $name)
    {
        $stub = parent::replaceClass($stub, $name);
        return str_replace('DummyService', $this->argument('name') . 'Service', $stub);
    }

    /**
     * Substitui a palavra DummyModel na stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceModel(&$stub, $name)
    {
        $class_name = ucfirst($this->argument('name'));
        $class_name = str_replace('Service', '', $class_name);

        $stub = str_replace('DummyModel', $class_name, $stub);

        return $this;
    }

    /**
     * Substitui a palavra dummyModelService na stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return $this
     */
    protected function replaceModelService(&$stub, $name)
    {
        $class_name = strtolower($this->argument('name'));
        $class_name = str_replace('service', '', $class_name);

        $stub = str_replace('dummyModel', $class_name, $stub);

        return $this;
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceModel($stub, $name)
            ->replaceModelService($stub, $name)
        ->replaceClass($stub, $name);
    }

    /**
     * Obtpem o arquivo stub para o gerador.
     *
     * @return string
     */
    protected function getStub()
    {
        return  base_path() . '/stubs/service.stub';
    }
    /**
   * Obtém o namespace padrão para a classe.
   *
   * @param  string  $rootNamespace
   * @return string
   */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Services';
    }

    /**
     * Obtém os argumentos do comando do console.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the service.'],
        ];
    }
}
