<?php


namespace ErisRayanesh\Laramod\Providers\Concerns;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Reflector;
use Illuminate\View\Compilers\BladeCompiler;

trait ProvidesBladeComponents
{

    protected function publishBladeComponents()
    {
        $sourcePath = $this->modulePath($this->getBladeComponentsPath());
        $componentsPath = resource_path('views' . DIRECTORY_SEPARATOR . 'components' .
            DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $this->getModuleName());
        $this->publishes([$sourcePath => $componentsPath], ['components', $this->getModuleName() . '-module-components']);
    }

    /**
     * Register views.
     *
     * @return void
     */
    protected function registerBladeComponents()
    {
        Blade::componentNamespace($this->getBladeComponentsNamespace(), $this->getBladeComponentsPrefix());

        if (!empty($components = $this->getBladeComponents())) {
            $this->loadViewComponentsAs($this->getBladeComponentsPrefix(), $components);
        }
    }

    protected function getBladeComponentsPath(): string
    {
        return 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'components';
    }

    protected function getBladeComponentsNamespace(): string
    {
        return (new \ReflectionClass(static::class))->getNamespaceName() . "\\Views\\Components";
    }

    protected function getBladeComponentsPrefix(): string
    {
        return $this->getModuleName();
    }

    /**
     * @return array
     */
    protected function getBladeComponents(): array
    {
        return [];
    }
}
