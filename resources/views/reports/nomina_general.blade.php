<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rol de Pago</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <section class="header" style ="top: -287px;">
        <table cellpadding="0" cellspancing="0" width="100%">
            <tr>
                <td width="35%" class="text-left" style="vertical-align: top; padding-top: 10px">
                    <span style="font-size: 10px"><strong>{{$tblcia['razonsocial']}}</strong></span>
                    <table width="100%" cellpadding="0" cellspancing="0">
                        <tr>
                            <td class="text-left"><span style="font-size: 10px"><strong>Ruc: </strong>{{$tblcia['ruc']}}</span></td>
                        </tr>
                        <tr>
                            <td class="text-left"><span style="font-size: 10px"><strong>Teléfono: </strong>{{$tblcia['telefono']}}</span></td>
                        </tr>
                        <tr>
                            <td class="text-left"><span style="font-size: 10px"><strong>Dirección: </strong>{{$tblcia['ubicacion']}}</span></td>
                        </tr>
                    </table>
                </td>
                <td width="30%" class="text-center text-uppercase" style="vertical-align: top; padding-top: 10px">
                    <span style="font-size: 10px"><strong>{{$roldatos['descripcion']}} {{$roldatos['remuneracion']}}</strong></span>
                    <table width="100%" cellpadding="0" cellspancing="0">
                        <tr>
                            <td class="text-center">
                                <span style="font-size: 10px"><strong>DEL </strong>{{$roldatos['fechaini']}}</span>
                                <span style="font-size: 10px"><strong>AL </strong>{{$roldatos['fechafin']}}</span>
                            </td>
                        </tr>
                    </table>
                </td> 
                <td width="35%" class="text-right" style="vertical-align: top; padding-top: 10px">
                    <img src="../public/assets/images/companies/logocia.png" width="150px" height="60px">
                </td>        
            <tr>
        </table>
        <br>
    </section>

    <section class="header" style ="top: -287px;">
    </section>

    <section style ="margin-top: -110px;">
        <table cellpadding="0" cellspacing="0" class="table table-sm align-middle" style="font-size:8px">
            <thead class="table-light">
                <tr>
                    <th class="text-center" style="width: 30px;">Código</th>
                    <th class="text-center" style="width: 180px;">Empleados</th>
                    <th class="text-center">Cédula</th>
                    @foreach ($etiqueta as $index => $head)
                        @if($index<=10)
                        <th class="text-center" style="width: 50px;">{{$head['etiqueta']}}</th>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <th colspan="3"></th>
                    @foreach ($etiqueta as $index => $head)
                        @if($index>10)
                        <th class="text-center" style="width: 60px;">{{$head['etiqueta']}}</th>
                        @endif
                    @endforeach
                </tr>
            <thead>
            <tbody>
                @foreach ($tblrecords as $fil => $data)
                <tr>
                    <td> {{$data['id']}} </td>
                    <td> {{$data['nom']}} </td>
                    <td> {{$data['nui']}} </td>
                    @foreach ($etiqueta as $index => $head)
                        @if($index<=10)
                        <td class="text-right"> {{number_format($data[$head['codigo']],2)}} </td>
                        @endif
                    @endforeach
                </tr>
                <tr>
                    <td colspan="3"></td>
                    @foreach ($etiqueta as $index => $head)
                        @if($index>10)
                            @if ($head['codigo']=='TOTPAG')
                                <td class="text-right"><strong>{{number_format($data[$head['codigo']],2)}}</strong></td>
                            @else
                                <td class="text-right"> {{number_format($data[$head['codigo']],2)}}</td>
                            @endif
                        @endif
                    @endforeach
                </tr>

                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"></td>
                    <td class="text-center">
                        <span><b>TOTAL GENERAL:<b></span>
                    </td>
                    @foreach ($etiqueta as $index => $head)
                        @if($index<=10)

                        @endif
                    @endforeach 
                </tr>
            </tfoot>
        </table>
    </section>
    <section>
        <div class="row">
            <span style="font-size: 10px"><strong>Neto a Pagar: </strong> {{$valorletra}} </span>
        </div>
        <div class="row">
            <span style="font-size: 10px"><strong>Empleados: </strong>{{count($tblrecords)}}</span>
        </div>
    </section>
    <section>
        <table cellpadding="0" cellspacing="0" class="table-sm" width="100%">
            <tr style="font-size:10px">
                <td width="35%" class="text-left">
                    <table width="100%" cellpadding="0" cellspancing="0">
                        <tr>
                            <td class="text-center text-uppercase"><span style="font-size: 10px"><strong></strong>{{$tblcia['elaborado']}}</span></td>
                        </tr>
                        <tr>
                            <td class="text-center"><span style="font-size: 10px"><strong>Elaborado Por</strong></span></td>
                        </tr>
                    </table>
                </td>
                <td width="30%" class="text-left">
                    <table width="100%" cellpadding="0" cellspancing="0">
                        <tr>
                            <td class="text-center text-uppercase"><span style="font-size: 10px"><strong></strong>{{$tblcia['revisado']}}</span></td>
                        </tr>
                        <tr>
                            <td class="text-center"><span style="font-size: 10px"><strong>Revisado Por</strong></span></td>
                        </tr>
                    </table>
                </td>
                <td width="35%" class="text-left">
                    <table width="100%" cellpadding="0" cellspancing="0">
                        <tr>
                            <td class="text-center text-uppercase"><span style="font-size: 10px"><strong></strong>{{$tblcia['visto_bueno']}}</span></td>
                        </tr>
                        <tr>
                            <td class="text-center"><span style="font-size: 10px"><strong>Visto Bueno</strong></span></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </section>

    <div style="position: absolute;
      display: inline-block;
      bottom: 0;
      width: 100%;
      height: 40px;">
    <footer>
        <table cellpadding="0" cellspacing="0" class="table-sm" width="100%">
            <tr style="font-size:10px">
                <td width="35%" class="text-left">
                    <span> ONTIME | Control de Nómina y Generación de Rol de Pagos</span>
                </td>
                <td width="30%" class="text-center">
                    Usuario:<span> {{auth()->user()->name}} </span>
                </td>
                <td width="35%" class="text-right">
                    Página <span class="pagenum"></span>
                </td>
            </tr>
        </table>
    </footer>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
