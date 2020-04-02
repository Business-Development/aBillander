<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Configuration Keys Language Lines :: Español
	|--------------------------------------------------------------------------
	|
	*/

	'Settings' => 'Configuración',
	'My Company' => 'Mi Empresa',
	'ALLOW_PRODUCT_SUBCATEGORIES.name' => 'Permitir Subcategorías de Productos',
	'ALLOW_PRODUCT_SUBCATEGORIES.help' => '1 : Permitir subcategorías. Los productos se asocian entonces a subcategorías. <br />0 : Los productos se asocian a categorías. <br />NOTA: las subcategorías son "Categorías-hijas".',
	'ALLOW_SALES_RISK_EXCEEDED.name' => 'Permitir ventas a Clientes con el Riesgo excedido',
	'ALLOW_SALES_RISK_EXCEEDED.help' => '',
	'ALLOW_SALES_WITHOUT_STOCK.name' => 'Permitir Ventas sin Stock',
	'ALLOW_SALES_WITHOUT_STOCK.help' => '',
	'CUSTOMER_ORDERS_NEED_VALIDATION.name' => 'Los Pedidos de Clientes necesitan Validación',
	'CUSTOMER_ORDERS_NEED_VALIDATION.help' => 'Sólo los Pedidos de Clientes que han sido validados podrán enviarse y facturarse.<br />1: Los Pedidos de Clientes se crearán con Estado = "<strong>draft</strong>".<br />0: Los Pedidos de Clientes se crearán con Estado = "<strong>confirmed</strong>".',
	'ALLOW_CUSTOMER_BACKORDERS.name' => 'Permitir retro-Pedidos',
	'ALLOW_CUSTOMER_BACKORDERS.help' => 'Se creará un nuevo Pedido si la Cantidad disponible es inferior a la Cantidad del Pedido.',
	'ENABLE_COMBINATIONS.name' => 'Activar Combinaciones',
	'ENABLE_COMBINATIONS.help' => 'Permitir crear Productos con Combinaciones.',
	'ENABLE_ECOTAXES.name' => 'Activar Eco-Impuestos',
	'ENABLE_ECOTAXES.help' => 'Permitir añadir una Eco-Tasa a los Productos.',
	'PRICES_ENTERED_WITH_ECOTAX.name' => 'Los Precios se introducen con la Eco-Tasa incluida',
	'PRICES_ENTERED_WITH_ECOTAX.help' => 'Cambiar esta opción no actualizará los Productos existentes.',
	'ENABLE_CUSTOMER_CENTER.name' => 'Activar el Centro de Clientes',
	'ENABLE_CUSTOMER_CENTER.help' => 'Permitir a los Clientes introducir Pedidos y más.',
	'ENABLE_SALESREP_CENTER.name' => 'Activar el Centro de Agentes Comerciales',
	'ENABLE_SALESREP_CENTER.help' => 'Permitir a los Agentes Comerciales introducir Pedidos y más.',
	'ENABLE_MANUFACTURING.name' => 'ENABLE_MANUFACTURING',
	'ENABLE_MANUFACTURING.help' => '',
	'MRP_WITH_STOCK.name' => 'MRP_WITH_STOCK',
	'MRP_WITH_STOCK.help' => '<p>Valores:</p><ul>	<li>	<p><strong>Sí</strong><br />	Calcula la Hoja de Producción teniendo en cuenta el Stock Físico.</p>	</li>	<li>	<p><strong>No</strong><br />	Calcula las necesidades de Productos Terminados y Semi-Elaborados sin tener en cuenta el Stock Físico.</p>	</li></ul>',
	'ENABLE_WEBSHOP_CONNECTOR.name' => 'Activar enlace con la Tienda online.',
	'ENABLE_WEBSHOP_CONNECTOR.help' => 'Para que el enlace funcione correctamente, puede ser necesario algún "package" adicional.',
	'ENABLE_FSOL_CONNECTOR.name' => 'Activar enlace con FactuSOL',
	'ENABLE_FSOL_CONNECTOR.help' => 'Para que el enlace funcione correctamente, puede ser necesario algún "package" adicional.',
	'SELL_ONLY_MANUFACTURED.name' => 'Vender sólo Productos Fabricados',
	'SELL_ONLY_MANUFACTURED.help' => '1 : Los Productos que se venden se obtienen mediante una Orden de Fabricación. <br />0 : Cualquier Producto puede seleccionarse para venta (empresa que comercializa Productos).',
	'MARGIN_METHOD.name' => 'Método para calcular el Margen',
	'MARGIN_METHOD.option.CST' => '<strong>CST</strong>: Sobre el Precio de Coste<br />Margen = (Precio de Venta - Precio de Coste) / Precio de Coste X 100',
	'MARGIN_METHOD.option.PRC' => '<strong>PRC</strong>: Sobre el Precio de Venta<br />Margen = (Precio de Venta - Precio de Coste) / Precio de Venta X 100',
	'MARGIN_METHOD.help' => '',
	'INCLUDE_SHIPPING_COST_IN_PROFIT.name' => 'Incluir el Coste de Envío para calcular el Margen',
	'INCLUDE_SHIPPING_COST_IN_PROFIT.help' => '',
	'NEW_PRICE_LIST_POPULATE.name' => 'Añadir Productos a una nueva Tarifa',
	'NEW_PRICE_LIST_POPULATE.help' => '1: Cuando se crea una nueva Tarifa, todos los Productos se añaden. El Precio se calcula según el Tipo de Tarifa.<br />0: Los Productos deberán añadirse manualmente a la nueva Tarifa.',
	'NEW_PRODUCT_TO_ALL_PRICELISTS.name' => 'Añadir un nuevo Producto a todas las Tarifas',
	'NEW_PRODUCT_TO_ALL_PRICELISTS.help' => '1: Los nuevos Productos se añaden a todas las Tarifas. El Precio se calcula según el Tipo de Tarifa.<br />0: Los nuevos Productos deberán añadirse manualmente a las Tarifas.',
	'PRICES_ENTERED_WITH_TAX.name' => 'Los Precios se introducen con IVA incluido',
	'PRICES_ENTERED_WITH_TAX.help' => 'Cambiar esta opción no actualizará los Productos existentes.',
	'PRODUCT_NOT_IN_PRICELIST.name' => 'Si un Producto no está en una tarifa',
	'PRODUCT_NOT_IN_PRICELIST.option.block' => '<strong>block</strong>: No permitir ventas',
	'PRODUCT_NOT_IN_PRICELIST.option.pricelist' => '<strong>pricelist</strong>: Calcular el Precio según el Tipo de tarifa',
	'PRODUCT_NOT_IN_PRICELIST.option.product' => '<strong>product</strong>: Tomar el Precio por defecto de los datos del Producto',
	'PRODUCT_NOT_IN_PRICELIST.help' => '',
	'QUOTES_EXPIRE_AFTER.name' => 'Un presupuesto expira después de',
	'QUOTES_EXPIRE_AFTER.help' => 'Días',
	'ROUND_PRICES_WITH_TAX.name' => 'Redondear Precios con el Impuesto incluido',
	'ROUND_PRICES_WITH_TAX.help' => '<p>Redondear los Precios en Facturas con el Impuesto incluido. El número de decimales resultante es el que corresponda a la Divisa del Precio.</p><p>Valores:</p><ul>	<li>	<p><strong>Sí</strong><br />	1.- Redondear el Precio con el Impuesto incluido.<br />	2.- Calcular y redondear el Precio sin el Impuesto.<br />	3.- El Impuesto se calcula por diferencia (no es necesario redondeo).</p>	</li>	<li>	<p><strong>No</strong><br />	1.- Redondear el Precio sin el Impuesto.<br />	2.- Calcular y redondear el Precio con el Impuesto incluido a partir del Precio sin el Impuesto ya redondeado.<br />	3.- El Impuesto se calcula por diferencia (no es necesario redondeo).</p>	</li></ul>',
	'DOCUMENT_ROUNDING_METHOD.name' => 'Método de redondeo para Documentos',
	'DOCUMENT_ROUNDING_METHOD.option.line' => '<strong>line</strong>: Redondeo por linea',
	'DOCUMENT_ROUNDING_METHOD.option.total' => '<strong>total</strong>: Redondeo en el total',
	'DOCUMENT_ROUNDING_METHOD.option.none' => '<strong>none</strong>: Sin redondeo',
	'DOCUMENT_ROUNDING_METHOD.option.custom' => '<strong>custom</strong>: Personalizado',
	'DOCUMENT_ROUNDING_METHOD.help' => 'El Total del Documento se calcula según el método elegido.',
	'SKU_AUTOGENERATE.name' => 'Generar un valor para el campo "Referencia" (SKU) del Producto',
	'SKU_AUTOGENERATE.help' => 'Generar automáticamente un valor secuencial para el campo "Referencia" (SKU) del Producto si no se introduce ninguno.',
	'TAX_BASED_ON_SHIPPING_ADDRESS.name' => 'Los Impuestos se calculan según',
	'TAX_BASED_ON_SHIPPING_ADDRESS.option.1' => 'La Dirección de Envío',
	'TAX_BASED_ON_SHIPPING_ADDRESS.option.0' => 'La Dirección de Facturación',
	'TAX_BASED_ON_SHIPPING_ADDRESS.help' => '',
	'Default Values' => 'Valores por Defecto',
	'DEF_CARRIER.name' => 'Transportista',
	'DEF_CARRIER.help' => '',
	'DEF_SHIPPING_METHOD.name' => 'Método de Envío para Clientes',
	'DEF_SHIPPING_METHOD.help' => '',
	'DEF_COMPANY.name' => 'Empresa',
	'DEF_COMPANY.help' => '',
	'DEF_COUNTRY.name' => 'País',
	'DEF_COUNTRY.help' => '',
	'DEF_CURRENCY.name' => 'Divisa',
	'DEF_CURRENCY.help' => 'Moneda por defecto.',
	'DEF_CUSTOMER_QUOTATION_SEQUENCE.name' => 'Serie de Presupuestos para Clientes',
	'DEF_CUSTOMER_QUOTATION_SEQUENCE.help' => '',
	'DEF_CUSTOMER_QUOTATION_TEMPLATE.name' => 'Plantilla de Presupuestos para Clientes',
	'DEF_CUSTOMER_QUOTATION_TEMPLATE.help' => '',
	'DEF_CUSTOMER_ORDER_SEQUENCE.name' => 'Serie de Pedidos para Clientes',
	'DEF_CUSTOMER_ORDER_SEQUENCE.help' => '',
	'DEF_CUSTOMER_ORDER_TEMPLATE.name' => 'Plantilla de Pedidos para Clientes',
	'DEF_CUSTOMER_ORDER_TEMPLATE.help' => '',
	'DEF_CUSTOMER_SHIPPING_SLIP_SEQUENCE.name' => 'Serie de Albaranes para Clientes',
	'DEF_CUSTOMER_SHIPPING_SLIP_SEQUENCE.help' => '',
	'DEF_CUSTOMER_SHIPPING_SLIP_TEMPLATE.name' => 'Plantilla de Albaranes para Clientes',
	'DEF_CUSTOMER_SHIPPING_SLIP_TEMPLATE.help' => '',
	'DEF_CUSTOMER_INVOICE_SEQUENCE.name' => 'Serie de Facturas para Clientes',
	'DEF_CUSTOMER_INVOICE_SEQUENCE.help' => '',
	'DEF_CUSTOMER_INVOICE_TEMPLATE.name' => 'Plantilla de Facturas para Clientes',
	'DEF_CUSTOMER_INVOICE_TEMPLATE.help' => '',
	'CUSTOMER_INVOICE_BANNER.name' => 'Banner en Factura',
	'CUSTOMER_INVOICE_BANNER.help' => 'Este texto aparece en la Cabecera de las Facturas de Clientes.',
	'CUSTOMER_INVOICE_TAX_LABEL.name' => 'Etiqueta para Impuestos',
	'CUSTOMER_INVOICE_TAX_LABEL.help' => 'Este texto aparece en la Cabecera de las columnas de Impuesto en las Facturas de Clientes.',
	'CUSTOMER_INVOICE_CAPTION.name' => 'Pie de Factura',
	'CUSTOMER_INVOICE_CAPTION.help' => 'Este texto aparece en el pie de las Facturas de Clientes.',
	'DEF_CUSTOMER_PAYMENT_METHOD.name' => 'Forma de Pago para Clientes',
	'DEF_CUSTOMER_PAYMENT_METHOD.help' => '',
	'DEF_LANGUAGE.name' => 'Idioma',
	'DEF_LANGUAGE.help' => '',
	'DEF_MEASURE_UNIT_FOR_BOMS.name' => 'Unidad de Medida para BOMs',
	'DEF_MEASURE_UNIT_FOR_BOMS.help' => 'Unidad de Medida por defecto para Listas de Materiales.',
	'DEF_MEASURE_UNIT_FOR_PRODUCTS.name' => 'Unidad de Medida para Productos',
	'DEF_MEASURE_UNIT_FOR_PRODUCTS.help' => 'Unidad de Medida por defecto para Productos y Combinaciones.',
	'DEF_OUTSTANDING_AMOUNT.name' => 'Riesgo Máximo',
	'DEF_OUTSTANDING_AMOUNT.help' => 'Riesgo Máximo permitido para un Cliente. Use el punto "." para separar los decimales.',
	'DEF_TAX.name' => 'Tipo de Impuesto',
	'DEF_TAX.help' => 'Tipo de Impuesto por defecto para Productos y Combinaciones.',
	'DEF_WAREHOUSE.name' => 'Almacén',
	'DEF_WAREHOUSE.help' => '',
	'Other' => 'Otros',
	'DEF_ITEMS_PERAJAX.name' => 'Items por consulta Ajax',
	'DEF_ITEMS_PERAJAX.help' => 'Número de items (máximo) devuelto por una consulta Ajax.',
	'DEF_ITEMS_PERPAGE.name' => 'Items por página',
	'DEF_ITEMS_PERPAGE.help' => 'Número de items (máximo) para resultados paginados.',
	'DEF_LOGS_PERPAGE.name' => 'Registros del log por página',
	'DEF_LOGS_PERPAGE.help' => 'Número de registros del log (máximo) para resultados paginados.',
	'DEF_PERCENT_DECIMALS.name' => 'Decimales en Porcentajes',
	'DEF_PERCENT_DECIMALS.help' => 'Número de decimales para porcentajes.',
	'DEF_QUANTITY_DECIMALS.name' => 'Decimales en Cantidades',
	'DEF_QUANTITY_DECIMALS.help' => 'Número de decimales para cantidades (stock, etc.).',

	'BUSINESS_NAME_TO_SHOW.name' => 'Nombre de Proveedores y Clientes que se mostrará ',
	'BUSINESS_NAME_TO_SHOW.option.fiscal' => '<strong>fiscal</strong>: Mostrar el Nombre Fiscal (Razón Soial)',
	'BUSINESS_NAME_TO_SHOW.option.commercial' => '<strong>commercial</strong>: Mostrar el Nombre Commercial',
	'BUSINESS_NAME_TO_SHOW.help' => 'Este nombre se mostrará en informes y campos de búsqueda.',
	'ALLOW_IP_ADDRESSES.name' => 'Acceso por Dirección IP',
	'ALLOW_IP_ADDRESSES.help' => 'Sólo estas Direcciones IP tendrán acceso a aBillander. Lista separada por comas.',
	'MAX_DB_BACKUPS.name' => 'Número Máximo de Copias de la Base de Datos en el Servidor',
	'MAX_DB_BACKUPS.help' => '',
	'MAX_DB_BACKUPS_ACTION.name' => 'Si se alcanza el Número Máximo de Copias',
	'MAX_DB_BACKUPS_ACTION.option.delete'  => '<strong>delete</strong>: Borrar las más antiguas',
	'MAX_DB_BACKUPS_ACTION.option.email'   => '<strong>email</strong>: Aviso por email',
	'MAX_DB_BACKUPS_ACTION.option.nothing' => '<strong>nothing</strong>: No hacer nada',
	'MAX_DB_BACKUPS_ACTION.help' => '',

	'RECENT_SALES_CLASS.name' => 'El Precio de las últimas ventas se toma de',
	'RECENT_SALES_CLASS.option.CustomerOrder' => '<strong>CustomerOrder</strong>: Ultimos Pedidos',
	'RECENT_SALES_CLASS.option.CustomerShippingSlip' => '<strong>CustomerShippingSlip</strong>: Ultimos Albaranes',
	'RECENT_SALES_CLASS.option.CustomerInvoice' => '<strong>CustomerInvoice</strong>: Ultimas Facturas',
	'RECENT_SALES_CLASS.help' => 'El Precio de las últimas ventas se visualiza cuando se añade una línea a un Documento.',
	'ABI_IMPERSONATE_TIMEOUT.name' => 'ABI_IMPERSONATE_TIMEOUT',
	'ABI_IMPERSONATE_TIMEOUT.help' => '',
	'ABI_TIMEOUT_OFFSET.name' => 'ABI_TIMEOUT_OFFSET',
	'ABI_TIMEOUT_OFFSET.help' => '',
	'ABI_MAX_ROUNDCYCLES.name' => 'ABI_MAX_ROUNDCYCLES',
	'ABI_MAX_ROUNDCYCLES.help' => '',
	'ENABLE_CRAZY_IVAN.name' => 'ENABLE_CRAZY_IVAN',
	'ENABLE_CRAZY_IVAN.help' => '',
	'TIMEZONE.name' => 'Zona Horaria',
	'TIMEZONE.help' => 'Zona horaria admitida por PHP.',
	'USE_CUSTOM_THEME.name' => 'Usar Tema presonalizado',
	'USE_CUSTOM_THEME.help' => 'El Tema personalizado está en la carpeta <i>/resources/theme/</i>.',
	'DEVELOPER_MODE.name' => 'DEVELOPER_MODE',
	'DEVELOPER_MODE.help' => '',

	'Auto-SKU' => 'Auto-SKU',
	'SKU_PREFIX_LENGTH.name' => 'Prefijo',
	'SKU_PREFIX_LENGTH.help' => 'Se toma el ID del Producto. Si tiene una longitud (número de cifras) menor que este valor, se rellena con ceros por la izquierda hasta esta longitud.',
	'SKU_PREFIX_OFFSET.name' => 'Offset',
	'SKU_PREFIX_OFFSET.help' => 'Este valor se sumará al ID del Producto. Así se evitan valores de SKU demasiado cortos.',
	'SKU_SEPARATOR.name' => 'Separador',
	'SKU_SEPARATOR.help' => 'Este campo se colocará entre el prefijo y el sufijo.',
	'SKU_SUFFIX_LENGTH.name' => 'Sufijo',
	'SKU_SUFFIX_LENGTH.help' => 'Se toma el ID de la Combinación. Si tiene una longitud (número de cifras) menor que este valor, se rellena con ceros por la izquierda hasta esta longitud.',
	'Auto-SKU.help' => '<blockquote><p>Ejemplo:</p><p>SKU_PREFIX_LENGTH = 6</p><p>SKU_PREFIX_OFFSET = 10000</p><p>SKU_SUFFIX_LENGTH = 3</p><p>SKU_SEPARATOR = "-" (sin comillas)</p><p>ID de Producto = 323</p><p>ID de Combinación = 12</p><p><strong>SKU</strong> = 010323-012</p><p>Si SKU_SUFFIX_LENGTH = 1, entonces <strong>SKU</strong> = 010323-12.</p><p>Si no es una Combinación (ID de Combinación = 0), entonces <strong>SKU</strong> = 010323.</p></blockquote>',
	
	'Customer Center' => 'Centro de Clientes',
	'ABCC_HEADER_TITLE.name' => 'Texto de Cabecera',
	'ABCC_HEADER_TITLE.help' => 'Aparece en la esquina superior izquierda de cada página.',
	'ABCC_EMAIL.name' => 'Dirección de Correo',
	'ABCC_EMAIL.help' => 'Los Correos Electrónicos del Centro de Clientes serán enviados esta dirección.',
	'ABCC_EMAIL_NAME.name' => 'Nombre de la Dirección de Correo',
	'ABCC_EMAIL_NAME.help' => 'Este Nombre aparecerá en los Correos Electrónicos del Centro de Clientes.',
	'ABCC_DEFAULT_PASSWORD.name' => 'Contraseña por defecto',
	'ABCC_DEFAULT_PASSWORD.help' => 'Esta Contraseña será asignada cuando se permite a un Cliente acceder al Centro de Clientes. Más adelante podrá cambiarse. Por seguridad, la Contraseña debe tener <strong>al menos ocho (8) caracteres</strong>.',
	'ABCC_STOCK_SHOW.name' => 'Mostrar Stock',
	'ABCC_STOCK_SHOW.option.none' => '<strong>none</strong>: No mostrar',
	'ABCC_STOCK_SHOW.option.label' => '<strong>label</strong>: Código de color',
	'ABCC_STOCK_SHOW.option.amount' => '<strong>amount</strong>: Mostrar Cantidad',
	'ABCC_STOCK_SHOW.help' => '',
	'ABCC_STOCK_THRESHOLD.name' => 'Umbral de Stock',
	'ABCC_STOCK_THRESHOLD.help' => 'Cuando el Stock es inferior a esta cantidad, aparece el aviso "Poco Stock".',
	'ABCC_OUT_OF_STOCK_PRODUCTS.name' => 'Cuando no hay Stock',
	'ABCC_OUT_OF_STOCK_PRODUCTS.option.hide' => '<strong>hide</strong>: No mostrar el Producto',
	'ABCC_OUT_OF_STOCK_PRODUCTS.option.deny' => '<strong>deny</strong>: Denegar Pedidos',
	'ABCC_OUT_OF_STOCK_PRODUCTS.option.allow' => '<strong>allow</strong>: Permitir Pedidos',
	'ABCC_OUT_OF_STOCK_PRODUCTS.help' => '',
	'ABCC_OUT_OF_STOCK_PRODUCTS_NOTIFY.name' => 'Avisar al Cliente "Cuando no hay Stock" tiene el valor "Permitir Pedidos"',
	'ABCC_OUT_OF_STOCK_PRODUCTS_NOTIFY.help' => '',
	'ABCC_OUT_OF_STOCK_TEXT.name' => 'Texto que se mostrará cuando se permiten Pedidos sin Stock',
	'ABCC_OUT_OF_STOCK_TEXT.help' => '',
	'ABCC_ORDERS_NEED_VALIDATION.name' => 'Los Pedidos de Clientes necesitan Validación',
	'ABCC_ORDERS_NEED_VALIDATION.help' => '1: Los Pedidos grabados por Clientes se crearán con Estado = "<strong>draft</strong>".<br />0: Los Pedidos grabados por Clientes se crearán con Estado = "<strong>confirmed</strong>".',
	'ABCC_ENABLE_QUOTATIONS.name' => 'Activar Presupuestos',
	'ABCC_ENABLE_QUOTATIONS.help' => 'El Cliente podrá solicitar Presupuesto para el contenido del Carrito.',
	'ABCC_ENABLE_SHIPPING_SLIPS.name' => 'Activar Albaranes',
	'ABCC_ENABLE_SHIPPING_SLIPS.help' => 'El Cliente podrá ver sus Albaranes.',
	'ABCC_ENABLE_INVOICES.name' => 'Activar Facturas',
	'ABCC_ENABLE_INVOICES.help' => 'El Cliente podrá sus Facturas y sus Pagos pendientes.',
	'ABCC_ENABLE_MIN_ORDER.name' => 'Activar Pedido mínimo',
	'ABCC_ENABLE_MIN_ORDER.help' => '',
	'ABCC_MIN_ORDER_VALUE.name' => 'Importe Pedido mínimo',
	'ABCC_MIN_ORDER_VALUE.help' => '',

	'ABCC_DISPLAY_PRICES_TAX_INC.name'     => '¿Mostrar los Precios con el Impuesto incluido?',
	'ABCC_DISPLAY_PRICES_TAX_INC.help'     => '',

	'ABCC_ENABLE_NEW_PRODUCTS.name' => 'Activar "Nuevos Productos"',
	'ABCC_ENABLE_NEW_PRODUCTS.help' => 'El Cliente verá el enlace <strong><em>"Novedades"</em></strong> .',
	'ABCC_NBR_DAYS_NEW_PRODUCT.name' => 'Número de días en los que el Producto es considerado una "novedad"',	// Number of days for which the Product is considered "new"',
	'ABCC_NBR_DAYS_NEW_PRODUCT.help' => '',
	'ABCC_NBR_ITEMS_IS_QUANTITY.name' => 'Mostrar Items en el Carrito',
	'ABCC_NBR_ITEMS_IS_QUANTITY.option.quantity' => '<strong>quantity</strong>: Mostrar el Total de Items.',
	'ABCC_NBR_ITEMS_IS_QUANTITY.option.items' => '<strong>items</strong>: Mostrar el Número de Items diferentes.',
	'ABCC_NBR_ITEMS_IS_QUANTITY.option.value' => '<strong>value</strong>: Mostrar el Valor Total de los Items (Precio Total).',
	'ABCC_NBR_ITEMS_IS_QUANTITY.help' => '',
	'ABCC_ITEMS_PERPAGE.name' => 'Items por página',
	'ABCC_ITEMS_PERPAGE.help' => 'Número de items (máximo) para resultados paginados.',
	'ABCC_CART_PERSISTANCE.name' => 'Persistencia del Carrito (días)',
	'ABCC_CART_PERSISTANCE.help' => 'Número de días durante los que se preservará el Precio de los Productos en el Carrito.',
	'ABCC_DEFAULT_ORDER_TEMPLATE.name' => 'Plantilla de Pedidos para Clientes',
	'ABCC_DEFAULT_ORDER_TEMPLATE.help' => 'Para visualizar los Pedidos en formato PDF desde el Centro de Clientes se usará esta Plantilla.',
	'ABCC_ORDERS_SEQUENCE.name' => 'Serie de Pedidos para Clientes',
	'ABCC_ORDERS_SEQUENCE.help' => 'Los Pedidos que se crean en el Centro de Clientes irán a esta Serie.',
	'ABCC_QUOTATIONS_SEQUENCE.name' => 'Serie de Presupuestos para Clientes',
	'ABCC_QUOTATIONS_SEQUENCE.help' => 'Los Presupuestos que se solicitan desde el Centro de Clientes irán a esta Serie.',
	
	'Sales Representative Center' => 'Centro de Agentes',
	'ABSRC_HEADER_TITLE.name' => 'Texto de Cabecera',
	'ABSRC_HEADER_TITLE.help' => 'Aparece en la esquina superior izquierda de cada página.',
	'ABSRC_EMAIL.name' => 'Dirección de Correo',
	'ABSRC_EMAIL.help' => 'Los Correos Electrónicos del Centro de Agentes serán enviados esta dirección.',
	'ABSRC_EMAIL_NAME.name' => 'Nombre de la Dirección de Correo',
	'ABSRC_EMAIL_NAME.help' => 'Este Nombre aparecerá en los Correos Electrónicos del Centro de Agentes.',
	'ABSRC_DEFAULT_PASSWORD.name' => 'Contraseña por defecto',
	'ABSRC_DEFAULT_PASSWORD.help' => 'Esta Contraseña será asignada cuando se permite a un Agente acceder al Centro de Agentes. Más adelante podrá cambiarse.',
	
	'ABSRC_ALLOW_ABCC_ACCESS.name' => 'Permitir dar acceso al Centro de Clientes',
	'ABSRC_ALLOW_ABCC_ACCESS.help' => 'El Agente puede permitir a un Cliente que acceda al Centro de Clientes.',
	'ABSRC_ITEMS_PERPAGE.name' => 'Items por página',
	'ABSRC_ITEMS_PERPAGE.help' => 'Número de items (máximo) para resultados paginados.',


	'All Keys' => 'Todas las Claves',
	'Configuration Keys' => 'Claves de Configuración',
	'Back to Configurations' => 'Volver a Configuración',
	'Date Updated' => 'Actualizado',
	'Configuration Keys - Create' => 'Claves de Configuración - Crear',
	'New Configuration Key' => 'Nueva Clave de Configuración',
	'Name' => 'Nombre',
	'Value' => 'Valor',
	'Description' => 'Descripción',
	'Configuration Keys - Edit' => 'Claves de Configuración - Modificar',
	'Edit Configuration Key' => 'Modificar Clave de Configuración',


];
