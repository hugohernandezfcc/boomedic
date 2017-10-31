@extends('adminlte::master')

@section('title', 'Boomedic')

@section('adminlte_css')
    <link rel="stylesheet"
          href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
    @stack('css')
    @yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
    'boxed' => 'layout-boxed',
    'fixed' => 'fixed',
    'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
<div>




                <style>
                .bordes{
                        background-color: #3E3D3D;
                        border-radius: 85px;
                        -moz-border-radius: 85px;
                        -webkit-border-radius: 85px;
                        border: 0px solid #3E3D3D;
                        border-collapse: separate;
                        border-spacing:0px 5px;
                        color: white;
                        font-family: sans-serif;
                        font-size: 13px;
                        text-align: center;
                        font-weight: bold;
                }
                .letras {
                        font-family: sans-serif;
                        font-size: 11px;
                }
                </style>


        <table width="100%" class="letras">
         <tr style="text-align: center;">
            <td width="25%" rowspan="8" align="top"><IMG SRC="https://upload.wikimedia.org/wikipedia/commons/a/ab/Logo_TV_2015.png" width=200 height=200></td>
            <td width="35%" rowspan="8" align="top">Name<br/>Rfc<br/>Dirección: ePais, eEstado, Municipio eMunicipio, Colonia eColonia, Calle eCalle, eNoEX <br/> Código Postal: eCP</td>
            <td width="40%">Comprobante Fiscal Digital a través de internet</td></tr>
        <tr><td class="bordes">FACTURA</td></tr>
        <tr style="text-align: center;">
            <td style="color: #545454"><br/>Folio Fiscal Digital:</td></tr>
        <tr style="text-align: center;">
            <td>hgj343532k52k3523</td></tr>
        <tr style="text-align: center"><td style="color: #545454">No. de Serie del Certificado SAT</td></tr> 
        <tr style="text-align: center"><td>fsdkfy873wf2iu3hfkfhfhfshdf</td></tr>
        <tr style="text-align: center"><td style="color: #545454">Fecha y Hora de Certificación</td></tr>
        <tr style="text-align: center"><td>2017kjnsfnwefw</td></tr>         
       </table>
       <table width="100%" class="letras">
               <tr style="color: #545454">
                <td align="center">Fecha y Hora de Emisión</td>
                <td align="center">Serie</td>
                <td align="center">Folio</td>
                <td align="center">No de Certificado del Emisor</td>
                <td align="center">Moneda</td>
                <td align="center">Tipo de Comprobante</td>
               </tr>
               <tr>
                <td align="center">fecha</td>
                <td align="center">serie</td>
                <td align="center">folio</td>
                <td align="center">noCertificado</td>
                <td align="center">moneda</td>
                <td align="center">tipoComprobante</td>
               </tr>
       </table><br/><br/>
       <table width="100%" class="letras">
               <tr class="bordes"><td colspan="4" align="center">FACTURAR A:</td></tr>
               <tr><td style="color: #545454">Razón Social:</td><td>razoncuenta</td><td style="color: #545454">RFC:</td><td>rfc</td></tr>
               <tr><td style="color: #545454">Domicilio:</td><td>pais, Municipio municipio, Colonia colonia, Nro noExterior noInterior</td><td style="color: #545454">Referencia:</td><td>No aplica</td></tr>
               <tr><td style="color: #545454">Ciudad:</td><td>estado</td><td style="color: #545454">Código Postal:</td><td>postal</td></tr>
       </table><br/>
       <table width="100%" class="letras">
        
                <tr >
                <td class="bordes">CLAVE</td>
                <td class="bordes">CANTIDAD</td>
                <td class="bordes">UNIDAD DE MEDIDA</td>
                <td class="bordes">DESCRIPCIÓN</td>
                <td class="bordes">PRECIO UNITARIO</td>
                <td class="bordes">IMPORTE</td>
               </tr>

               <tr >
                <td align="center">Product2.Name</td>
                <td align="center">Quantity</td>
                <td align="center">UnidadMedida</td>
                <td align="center">Product.Name</td>
                <td align="center">UnitPrice</td>
                <td align="center">{TotalPrice</td>
               </tr>   

       </table>
       <table  class="letras">
               <tr>
                <td style="color: #545454" width="40%">Importe con Letra:</td><td width="40%">variable</td><td style="color: #545454" width="20%">SUB-TOTAL:</td><td>subtotal</td>
               </tr>
               <tr>
                <td style="color: #545454" width="40%">Forma de Pago:</td><td width="40%">formap</td><td style="color: #545454" width="20%">IVA:</td><td>totalIva</td>
               </tr>
               <tr>
                <td style="color: #545454" align="right" colspan="2">TOTAL:</td><td align="right" colspan="2">total</td>
               </tr>
       </table>


       <!-- SELLO FISCAL -->
       <br/><br/><br/><br/><br/><br/>
       <table width="100%" class="letras">
               <tr><td width="80%" align = "center">Lugar de Expedición:</td><td rowspan="7" width="20%">codigo</td></tr>
                <tr><td class="bordes">SELLO DIGITAL DEL EMISOR</td></tr>
                <tr><td>string</td></tr>
                <tr><td class="bordes">SELLO DIGITAL DEL SAT</td></tr>
                <tr><td>string</td></tr>
                <tr><td class="bordes">CADENA ORIGINAL DEL COMPLEMENTO DE CERTIFICACIÓN DIGITAL DEL SAT</td></tr>
                <tr><td>{!uuid}</td></tr>
               
       </table>

</div>
@stop