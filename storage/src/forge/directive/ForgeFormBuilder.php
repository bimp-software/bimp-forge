<?php

namespace Bimp\Forge\Directives;

class ForgeFormBuilder {
    /**
     * El codigo html final del formulario
     * @var string
     */
    private $formHtml = '';

    /**
     * El nombre del formulario, puede ser usado para seleccionar por javascript
     * @var string
     */
    private $formName = '';

    /**
     * El identificador unico del formulario
     * @var string
     */
    private $id = '';

    /**
     * La ruta de accion del formulario, donde enviara la información
     * @var string
     */
    private $action = '';

    /**
     * Todas las clases del formulario
     * @var array
     */
    private $classes = [];

    /**
     * El metodo a utilizar, puede ser solo GET o POST
     * @var string
     */
    private $method = '';

    /**
     * Metodo de encriptacion o content-type para enviar la informacion
     * @var string
     */
    private $encType = '';

    /**
     * Todos los campos personalizados insertados
     * @var array
     */
    private $customFields = [];

    /**
     * Todos los campos agregados al formulario
     * @var array
     */
    private $fields = [];

    /**
     * Todos los botones registrados para el formulario
     */
    private $buttons = [];

    /**
     * Todos los campos de tipo file registrados para el formulario
     * @var array
     */
    private $files = [];

    /**
     * Todos los campos de tipo range o slider registrados para el formulario
     * @var array
     */
    private $sliders = [];

    /**
     * Inicializacion del formulario
     * 
     * @param string $name
     * @param string $id
     * @param array $classes
     * @param string $action
     * @param boolean $post
     * @param boolean $sendFiles
     */
    function __construct($name, $id = null,$classes = [], $action = null, $post = true, $sendFiles = false){
        $this->formName = $name;
        $this->id = $id;
        $this->classes = $classes;
        $this->action = $action;
        $this->method = $post === true ? 'POST' : 'GET';
        $this->encType = $sendFiles === true ? 'multipart/form-data' : '';
    }

    /**
     * Metodo general para agregar compos repetitivos en estrucura
     * @param string $name
     * @param string $type
     * @param string $label
     * @param array $classes
     * @param string $id
     * @param boolean $required
     * @param array $options
     * @param string $defaultValue
     * @return void
     */
    private function addFields($name, $type, $label, $classes =[], $id = null, $required = false, $options = [], $defaultValue = null){
        $fields = [
            'name' => $name,
            'type' => $type,
            'label' => $label,
            'classes' => $classes,
            'id' => $id,
            'options' => $options,
            'defaultValue' => $defaultValue,
            'required' => $required === true
        ];

        $this->fields[] = $field;
    }

    /**
     * Agrega un campo personalizado o varios, basicamente inserta codigo html en el formulario
     * @param string $fields
     * @return void
     */
    function addCustomFields($fields){
        $customField = [
            'name' => null,
            'type' => 'custom',
            'label' => null,
            'classes' => [],
            'id' => null,
            'options' => [],
            'defaultValue' => null,
            'required' => null,
            'content' => $fields
        ];
        $this->fields = $customField;
        $this->customFields[] = $fields;
    }

    /**
     * Agrega un campo escondifo o hidden
     * @param string $name
     * @param string $label
     * @param array $classes
     * @param string $id
     * @param boolean $required
     * @param string $defaultValue
     * @return void
     */
    public function addHiddenField($name, $label, $classes = [], $id = null, $required = false, $defaultValue = null){
        $this->addFields($name,'hidden',$label,$classes,$id,$required,[],$defaultValue);
    }

    /**
     * Agrega un campo de texto al formulario
     * @param string $name
     * @param string $label
     * @param array $classes
     * @param string $id
     * @param boolean $required
     * @param string $defaultValue
     * @return void
     */
    public function addTextField($name, $label, $classes = [], $id = null, $required = false, $defaultValue = null){
        $this->addFields($name,'text',$label,$classes,$id,$required,[],$defaultValue);
    }
    
    /**
     * Agrega un campo de tipo password o contraseña
     * @param string $name
     * @param string $label
     * @param array $classes
     * @param string $id
     * @param boolean $required
     * @param string $defaultValue
     * @return void
     */
    public function addPasswordField($name, $label, $classes = [], $id = null, $required = false, $defaultValue = null){
        $this->addFields($name,'password',$label,$classes,$id,$required,[],$defaultValue);
    }

    /**
     * Agrega un campo de tipo email
     * @param string $name
     * @param string $label
     * @param array $classes
     * @param string $id
     * @param boolean $required
     * @param string $defaultValue
     * @return void
     */
    public function addEmailField($name, $label, $classes = [], $id = null, $required = false, $defaultValue = null){
        $this->addFields($name,'email',$label,$classes,$id,$required,[],$defaultValue);
    }

    /**
     * Agrega un campo de tipo select y sus options
     * @param string $name
     * @param string $label
     * @param array $options
     * @param array $classes
     * @param string $id
     * @param boolean $required
     * @param string $defaultValue
     * @return void
     */
    public function addSelectField($name, $label, $options = [] ,$classes = [], $id = null, $required = false, $defaultValue = null){
        $this->addFields($name,'select',$label,$classes,$id,$required,$options,$defaultValue);
    }


}