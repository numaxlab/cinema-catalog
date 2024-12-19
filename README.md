# Cinema Catalog Laravel Package

## Instalación do paquete

`composer require numaxlab/cinema-catalog`

## Arquivo de configuración

- cinema-catalog.php

## Sobreescribir no paquete

### Sobreescribir un modelo

- Crear modelo
- Extender do modelo pai do paquete
- Crear o constructor:
  `    public function __construct(array $attributes = [])
  {
  parent::__construct($attributes);
}`

- Para engadir columnas ao $fillable:
  ` $this->mergeFillable(['labs', 'gender', 'archive']);
          `
- Para engadir columnas ao $casts
  `$this->mergeCasts(['labs']);`
- Para engadir columnas ao $translatable -> Copiar e engadir o atributo
- Cambiar o espacio de nomes na configuración do paquete ao do modelo do propio proxecto 


### Sobreescribir un controlador do CRUD

- Crear controlador
- Extender do controlador pai do paquete
- Sobreescribir método e engadir:
  `parent::setupCreateOperation()`
- Sobreescribir ruta no custom.php do proxecto
- No AppServiceProvider:
  `$this->app->bind(CinemaCatalogProjectCrudController::class, ProjectCrudController::class);`


