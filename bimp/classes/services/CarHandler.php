<?php

namespace Bimp\Forge\Services;

final class CartHandler{
    /**
     * Es el nombre de la clave dentro de las variables de sesión
     * @var string
     */
    public $session_Name = 'checkout-cart';

    /**
     * El carrito en si, todo su contenido y propiedades
     * @var array
     */
    private $cart;

    /**
     * El indicador unico del carrito, un token no repetible
     * @var string
     */
    private $id;

    /**
     * Todos los items o productos dentro del carrito de compras
     * @var array
     */
    private $items = [];

    /**
     * Representacion numerica del total de productos agregados en el carrito
     * @var integer
     */
    private $total_Items = 0;

    /**
     * La divisa por defecto del carrito
     * @var string
     */
    private $currency = 'CLP';

    /**
     * El subtotal de los items en el carrito antes de impuestos y descuentos
     * @var float
     */
    private $subtotal = 0;

    /**
     * El total de impuestos
     * @var float
     */
    private $taxes = 0;

    /**
     * Representa el procentaje de impuesto a cibrar 
     * base es 19 para el 19% en chile como IVA
     * @var float
     */
    private $taxesRate = 19;

    /**
     * Informacion del envío
     * CartShipping
     * @var array
     */
    private $shipping = [];

    /**
     * Todos los descuentos aplicables al carrito
     * @var float
     */
    private $discounts = 0;

    /**
     * Cupon de descuento aplicado en el carrito
     * @var array
     */
    private $coupon = [];

    /**
     * Monto total a pagar con impuestos, descuentos y envio
     * @var float
     */
    private $total;

    /**
     * Sufijo a ser utilizado por el sistema en sus ordenes o venats
     * @var string 
     */
    private $suffix = 'ORD';

    /**
     * Numero de compra o venta
     * @var mixed
     */
    private $orderId;

    /**
     * Extracto que aparecera en el resumen de compra y pasarelas de pago
     * @var string
     */
    private $description;

    /**
     * Toda la informacion del cliente nombre,email,direccion
     * @var array
     */
    private $customer = [];

    function __construct($keyName = null){
        $this->session_Name = $keyName !== null ? $keyName : $this->session_Name;

        if(!isset($_SESSION[$this->session_name])){
            
        }
    }

    
}