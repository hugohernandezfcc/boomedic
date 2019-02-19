<?php

return [

    'full_name'                   => 'Nombre completo',
    'email'                       => 'Correo electrónico',
    'password'                    => 'Contraseña',
    'retype_password'             => 'Confirmar contraseña',
    'birthdate'                   => 'Fecha de nacimiento',
    'female'                      => 'Femenino',
    'male'                        => 'Masculino', 
    'other'                       => 'Otro',  
    'single'                      => 'soltero(a)',
    'married'                     => 'Casado(a)',     
    

    'remember_me'                 => 'Recuerdame',
    'register'                    => 'Registre',
    'register_a_new_membership'   => 'Registrarme',
    'i_forgot_my_password'        => '¿Olvidaste tu contraseña?',
    'i_already_have_a_membership' => 'Tengo una cuenta',
    'sign_in'                     => 'Entrar',
    'log_out'                     => 'Salir',
    'toggle_navigation'           => 'Navegación de palanca',
    'login_message'               => 'Inicio de sesión',
    'register_message'            => 'Registre una nueva cuenta',
    'password_reset_message'      => 'Restablecer la contraseña',
    'reset_password'              => 'Restablecer la contraseña',
    'send_password_reset_link'    => 'Enviar link de restablecimiento de contraseña',
    'messageLogout'               => 'Se ha cerrado tu sesión.',



    'i_am_a_doctor'                      => 'Soy médico',
    'i_am_a_patient'                     => 'Soy paciente',   
    'Message_to_doctor'                  => 'Este formulario es solo para Médicos.',
    'register_a_new_membership_doctor'   => 'Registrarme como Médico',
    'professional_license'               => 'Cédula profesional de médico',
    'medical_society'                    => 'Sociedad de médicos',
    'siblings'                            => 'Hermano(a)',
    'mother'                             => 'Madre',
    'father'                             => 'Padre',
    'wife'                               => 'Esposa',
    'son'                                => 'Hijo(a)',
    'husband'                            => 'Esposo',
    'grandparents'                       => 'Abuelo(a)',
    'uncles'                             => 'Tío(a)',

    /* Days */
    'Mon'   => 'Lun',
    'Tue'   => 'Mar',
    'Wed'   => 'Mie',
    'Thu'   => 'Jue',
    'Fri'   => 'Vie',
    'Sat'   => 'Sab',                    
    'Sun'   => 'Dom',

    /* Months */
    'January'       => 'Enero',
    'February'      => 'Febrero',
    'March'         => 'Marzo',
    'April'         => 'Abril', 
    'May'         => 'Mayo', 
    'June'         => 'Junio', 
    'July'         => 'Julio', 
    'August'         => 'Agosto', 
    'September'         => 'Septiembre', 
    'October'         => 'Octubre', 
    'November'         => 'Noviembre', 
    'December'         => 'Diciembre',     


    /* System Error */
    '150'        => 'Error: falla general del sistema.',
    '236'        => 'Falla del procesador.',
    '500'        => 'Error de servidor interno.',


    /* Missing Field */ 
    '101'       => 'Falta la solicitud en uno o más campos',


    /* Invalid Data */  
    '241'       => 'El ID de solicitud referenciado no es válido para todas las transacciones de seguimiento.',
    '242'       => 'El ID de solicitud no es válido.',
    '102'       => 'Uno o más campos en la solicitud contienen datos no válidos.',
    '110'       => 'Cantidad parcial aprobada.',
    '220'       => 'Rechazo genérico.',
    '222'       => 'La cuenta de clientes está congelada',
    '237'       => 'La autorización ya se ha revertido.',
    '238'       => 'La transacción ya se ha resuelto.',
    '243'       => 'La transacción ya ha sido resuelta o revertida.',
    '247'       => 'Solicitó un crédito por una captura que fue anulada previamente.',
    '248'       => 'Su procesador rechazó la solicitud de boleto.',
    '251'       => 'Las tarjetas de débito sin PIN utilizan la frecuencia o la cantidad máxima por uso que se ha excedido.',
    '254'       => 'La cuenta tiene prohibido procesar reembolsos independientes.',
    '450'       => 'Número de apartamento faltante o no encontrado.',
    '451'       => 'Insuficiente información de la dirección.',
    '452'       => 'El número de la casa no se encuentra en la calle.',
    '453'       => 'Se encontraron coincidencias de direcciones múltiples.',
    '454'       => 'Identificador de caja no encontrado o fuera del rango.',
    '455'       => 'Identificador de servicio de ruta no encontrado o fuera del rango.',
    '456'       => 'El nombre de la calle no se encuentra en el código postal.',
    '457'       => 'Código postal no encontrado en la base de datos.',
    '458'       => 'No se puede verificar o corregir la dirección.',
    '459'       => 'Se encontraron coincidencias de direcciones múltiples (internacional)',
    '460'       => 'Coincidencia de dirección no encontrada (no se da ninguna razón)',
    '461'       => 'Juego de caracteres no compatible',
    '475'       => 'El titular de la tarjeta está inscrito en la autenticación de Payer.',
    '476'       => 'Se encontró un problema de autenticación de Payer. Payer no se pudo autenticar.',
    '701'       => 'País de la factura de exportación / país de la nave coinciden',
    '702'       => 'Coincidencia de país de correo electrónico de exportación',
    '703'       => 'País de nombre de host y País de IP coincidente',
    '400'       => 'Fallaron las validaciones',


    /* Duplicate transaction */
    '104'       => 'Transacción Duplicada: el Código de referencia enviado con esta solicitud de autorización coincide con el Código de referencia de otra solicitud de autorización que envió en los últimos 15 minutos.',


     /* System Timeout */
    '151'       => 'Error: se recibió la solicitud pero hubo un tiempo de espera del servidor. Este error no incluye los tiempos de espera entre el cliente y el servidor.',
    '152'       => 'Error: se recibió la solicitud, pero un servicio no terminó de ejecutarse a tiempo.',
    '250'       => 'Error: se recibió la solicitud, pero hubo un tiempo de espera en el procesador de pagos.',


    /* Card Declined */
    '200'       => 'La solicitud de autorización fue aprobada por el banco emisor pero rechazada por CyberSource porque no pasó el cheque del Servicio de verificación de direcciones (AVS).',


    /* Card Referred */
    '201'       => 'El banco emisor tiene preguntas sobre la solicitud. No recibe un código de autorización mediante programación, pero puede recibir uno verbalmente llamando al procesador.',


    /* Card Expired */
    '202'       => 'Tarjeta vencida. También puede recibir esto si la fecha de vencimiento que proporcionó no coincide con la fecha en que el banco emisor tiene el archivo.',


    /* Card Refused */
    '203'       => 'Tarjeta Rechazada: Ninguna otra información proporcionada por el banco emisor.',
    '204'       => 'Tarjeta Rechazada: Fondos insuficientes en la cuenta.',
    '205'       => 'Tarjeta Rechazada: Tarjeta anunciada como robada o perdida.',
    '207'       => 'Tarjeta Rechazada: El banco emisor no está disponible.',
    '208'       => 'Tarjeta inactiva o no está autorizada para transacciones que no están presentes en la tarjeta.',
    '209'       => 'Tarjeta Rechazada: Los dígitos de identificación de tarjeta American Express (CID) no coinciden.',
    '210'       => 'Tarjeta Rechazada: La tarjeta ha alcanzado el límite de crédito.',
    '211'       => 'Tarjeta Rechazada: Número de verificación de tarjeta no válida (CVN).',
    '221'       => 'Tarjeta Rechazada: El cliente emparejó una entrada en el archivo negativo de los procesadores.',


    /* CVN Error */
    '230'       => 'Error en CVV: La solicitud de autorización fue aprobada por el banco emisor, pero rechazada por CyberSource porque no pasó la verificación del número de verificación de la tarjeta.',


    /* Card Invalid */
    '231'       => 'Tarjeta Inválida: Número de cuenta no válido.',
    '233'       => 'Tarjeta Inválida: Rechazado por el procesador.',
    '234'       => 'Tarjeta Inválida: Existe un problema con la configuración de comerciante de CyberSource.',
    '240'       => 'Tarjeta Inválida: El tipo de tarjeta enviado no es válido o no se correlaciona con el número de tarjeta de crédito.',


    /* Card Unsupported */
    '232'       => 'Tarjeta no compatible: El procesador de pagos no acepta el tipo de tarjeta.',


    /*  Amount Invalid */
    '235'       => 'Monto Inválido: El monto solicitado excede el monto originalmente autorizado.',
    '239'       => 'Monto Inválido: El monto de la transacción solicitada debe coincidir con el monto de la transacción anterior.',


    /* Not Found */
    '400'       => 'El recurso no funciona',


    /* Not Voidable */
    '246'       => 'La captura o el crédito no son anulables porque la información de captura o crédito ya se ha enviado a su procesador.',


    /* Transaction Refused */
    '480'       => 'Transacción rechazada: El pedido está marcado para revisión por el Administrador de decisiones.',
    '481'       => 'Transacción rechazada: El pedido ha sido rechazado por el Gerente de decisión.',
    '520'       => 'Transacción rechazada: La solicitud de autorización fue aprobada por el banco emisor pero rechazada por CyberSource en función de su configuración de autorización inteligente.',
    '700'       => 'Transacción rechazada: El cliente hizo coincidir la Lista de partes denegadas',


];
