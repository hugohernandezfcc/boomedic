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
                        background-color: #2C2C2C;
                        border: 0px solid #696969;
                        border-collapse: collapse;
                        border-spacing:0px 5px;
                        color: white;
                        font-family: sans-serif;
                        font-size: 14px;
                        text-align: center;
                        font-weight: bold;

                }
                 .bordes2{
                        background-color: #9A9A9A;
                        border: 3px;
                        border-collapse: separate;
                        border-spacing:15px;
                        color: #151515;
                        font-family: sans-serif;
                        font-size: 14px;
                        text-align: center;
                        font-weight: bold;

                }
                .letras {
                        font-family: sans-serif;
                        font-size: 10px;
                        border-width: 5px;
                }
                .letras2 {
                        font-family: sans-serif;
                        font-size: 14px;
                         color: #3D3D3D;

                }
                </style>


        <table width="100%" class="letras">
         <tr>
            <td width="30%" align="top"><IMG SRC="http://www.cauca.gov.co/sites/default/files/tulogoaqui.jpg" width=150 height=150/></td>
            <td width="40%" style="color: #545454; margin-right: 1px;"><h1>RECETARIO MÉDICO DIGITAL</h1><h2>ID: Ejemplo</h2></td>
            <td width="30%" align="right"><img alt="" src="http://chart.apis.google.com/chart?cht=qr&amp;chs=130x130&amp;chl={{ $qr }}&amp;chld=H|0" /></td></tr>
       </table>
       <br/>
       <table width="60%" class="letras" align="right">
               <tr style="color: #545454">
                <td align="right">Emisión: {{ $date }}</td>
                <td align="right">Centro Médico: {{ $clinic }}</td>
               </tr>
       </table><br/>
       <hr align="right" width="60%" style="background-color: #9A9A9A; height: 3px; border:none;"  />
       <table width="100%" class="letras" style="border-collapse: collapse;">
               <tr class="bordes" ><td colspan="2" align="left" style="height: 28px; margin-left: 2px;">Datos del Paciente</td><td align="right" style="height: 28px;">Edad: {{ $age }}</td></tr><br/>
               <tr style="color: #32313D;"><td>Nombre: {{ $Paciente }}</td><td>Peso: {{ $peso }}Kg</td><td>Estatura: {{ $est }}</td></tr>
               <tr style="color: #32313D;"><td>Alergias: {{ $alergias}}</td><td>Teléfono: {{ $mobileP }}</td><td>Email: {{ $email }}</td></tr>
       </table>
      <table width="100%" class="letras" style="border-collapse: collapse;">
               <tr class="bordes" style="height: 200px;"><td colspan="2" align="left" style="height: 28px; margin-left: 2px;">Datos del Médico Facultativo</td></tr><br/>
               <tr style="color: #32313D;"><td>Nombre: {{ $nameMedic }}</td><td>Especialidad: {{ $espe }}</td></tr>
               <tr style="color: #32313D;"><td>Teléfono: {{ $phoneM }}</td><td>Cédula Profesional: {{ $lic }}</td></tr>
       </table>
              
       <table width="100%" class="letras" style="table-layout: fixed; width: 100%; ">
               <tr class="bordes" style="height: 200px;"><td colspan="4" align="center" style="height: 28px;">Datos de la Receta</td></tr><br/>
                <tr >
                <td class="bordes2" style="height: 33px;">Diagnóstico</td>
                <td class="bordes2" style="height: 33px;">Medicamento Prescrito</td>
                <td class="bordes2" style="height: 33px;">Presentación</td>
                <td class="bordes2" style="height: 33px;">Dosis/Modo de Empleo</td>
               </tr>
              <tr align="left" class="letras2">
                <td><div style="word-wrap: break-word;">{{ $diagnostico }}</div></td>
                <td align="center">{{ $medPres }}</td>
                <td align="center">{{ $presentacion }}</td>
                <td><div style="word-wrap: break-word;">{{ $dosis }}</div></td>
               </tr>    
       </table>
       <!--<table width="100%" class="letras">
        
                <tr >
                <td class="bordes2">Diagnóstico</td>
                <td class="bordes2">Medicamento Prescrito</td>
                <td class="bordes2">Presentación</td>
                <td class="bordes2">Dosis/Modo de Empleo</td>
               </tr>
               <tr>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
               </tr>    

       </table>-->
      



</div>
@stop