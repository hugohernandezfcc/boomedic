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

                <style>
                .bordes{
                        background-color: #3E3D3D;
                        border-radius: 30px;
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

   <!--{{ $stamp }} -->
        <table width="100%" class="letras">
         <tr style="text-align: center;">
            <td width="25%" rowspan="8" align="top"><IMG SRC="http://www.cauca.gov.co/sites/default/files/tulogoaqui.jpg" width=200 height=200></td>
            <td width="35%" rowspan="8" align="top">{{ $eRazon }}<br/>RFC: {{ $eRfc }}<br/>Dirección: {{ $DomicilioEmisor }}</td>
            <td width="40%">Comprobante Fiscal Digital a través de internet</td></tr>
        <tr ><td class="bordes" style="border-radius: 30px;" >FACTURA</td></tr>
        <tr style="text-align: center;">
            <td style="color: #545454"><br/>Folio Fiscal Digital:</td></tr>
        <tr style="text-align: center;">
            <td></td></tr>
        <tr style="text-align: center"><td style="color: #545454">No. de Serie del Certificado SAT</td></tr> 
        <tr style="text-align: center"><td></td></tr>
        <tr style="text-align: center"><td style="color: #545454">Fecha y Hora de Certificación</td></tr>
        <tr style="text-align: center"><td></td></tr>         
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
                <td align="center">{{ $fecha }}</td>
                <td align="center">{{ $serie }}</td>
                <td align="center">{{ $folio }}</td>
                <td align="center">{{ $noCertificado }}</td>
                <td align="center">{{ $currency }}</td>
                <td align="center">{{ $Type }}</td>
               </tr>
       </table><br/><br/>
       <table width="100%" class="letras">
               <tr class="bordes"><td colspan="4" align="center">FACTURAR A:</td></tr>
               <tr><td style="color: #545454">Razón Social:</td><td>{{ $businessName }}</td><td style="color: #545454">RFC:</td><td>{{ $RFC }}</td></tr>
               <tr><td style="color: #545454">Domicilio:</td><td>{{ $Domicilio }}</td><td style="color: #545454">Referencia:</td><td>No aplica</td></tr>
               <tr><td style="color: #545454">Ciudad:</td><td>{{ $state }}</td><td style="color: #545454">Código Postal:</td><td>{{ $PostalCode }}</td></tr>
       </table><br/>
       <table width="100%" class="letras">
        
                <tr >
                <td class="bordes">CLAVE SERVICIO</td>
                <td class="bordes">DESCRIPCIÓN</td>
                <td class="bordes">PRECIO</td>

               </tr>

               <tr>
                <td align="center">{{ $c1 }}</td>
                <td align="center">{{ $s1 }}</td>
                <td align="center">{{ $mon1 }}</td>
               </tr>   

               <tr>
                <td align="center">{{ $c2 }}</td>
                <td align="center">{{ $s2 }}</td>
                <td align="center">{{ $mon2 }}</td>
               </tr>   

              <tr>
                <td align="center">{{ $c3 }}</td>
                <td align="center">{{ $s3 }}</td>
                <td align="center">{{ $mon3 }}</td>
               </tr>   

       </table><br/><br/><br/>
              <table  class="letras">
               <tr>
                <td style="color: #545454" width="40%">Importe con Letra:</td><td width="40%"></td><td style="color: #545454" width="20%">SUB-TOTAL:</td><td>{{ $total }}</td>
               </tr>
               <tr>
                <td style="color: #545454" width="40%">Forma de Pago:</td><td width="40%">{{ $formp }}</td><td style="color: #545454" width="20%">IVA:</td><td>0,00</td>
               </tr>
               <tr>
                <td style="color: #545454" align="right" colspan="2">TOTAL:</td><td align="right" colspan="2">{{ $total }}</td>
               </tr>
       </table>


       <!-- SELLO FISCAL -->
       <br/><br/><br/><br/><br/><br/>
       <table width="100%" class="letras">
               <tr><td width="80%" align = "center">Lugar de Expedición: {{ $exp }}</td><td rowspan="7" width="20%"><IMG SRC="https://upload.wikimedia.org/wikipedia/commons/thumb/1/14/Codigo_QR.svg/250px-Codigo_QR.svg.png" width=100 height=100></td></tr>
                <tr><td class="bordes">SELLO DIGITAL DEL EMISOR</td></tr>
                <tr><td>string</td></tr>
                <tr><td class="bordes">SELLO DIGITAL DEL SAT</td></tr>
                <tr><td>selloSAT </td></tr>
                <tr><td class="bordes">CADENA ORIGINAL DEL COMPLEMENTO DE CERTIFICACIÓN DIGITAL DEL SAT</td></tr>
                <tr><td>uuid</td></tr>
               
       </table>

@stop