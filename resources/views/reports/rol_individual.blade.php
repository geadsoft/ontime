<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rol Individual</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <section class="header" style ="top: -287px;">
        <table cellpadding="0" cellspancing="0" width="100%">
        </table>
        <br>
    </section>

    <section class="header" style ="top: -287px;">
    </section>

    @foreach ($personas as $fil => $record)
        
        <section style ="margin-top: -110px;">
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
                                <span style="font-size: 10px"><strong>{{$roldatos['mes']}} / {{$roldatos['periodo']}}</strong></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <span style="font-size: 10px"><strong>DEL </strong>{{$roldatos['fechaini']}}</span>
                                    <span style="font-size: 10px"><strong>AL </strong>{{$roldatos['fechafin']}}</span>
                                </td>
                            </tr>
                        </table>
                    </td> 
                    <td width="35%" class="text-right" style="vertical-align: top; padding-top: 10px">
                        <img src="../public/assets/images/companies/logocia.png" width="100px" height="50px">
                    </td>        
                <tr>
            </table>
            <table cellpadding="0" cellspancing="0" width="100%">
                <td width="50%" class="text-left" style="vertical-align: top; padding-top: 10px">
                    <table width="100%" cellpadding="0" cellspancing="0">
                        <tr>
                            <span style="font-size: 10px"><strong>Cédula: </strong>{{$record->nui}}</span>
                        </tr>
                        <tr>
                            <span style="font-size: 10px"><strong>Empleado: </strong>{{$record->apellidos}} {{$record->nombres}}</span>
                        </tr>
                        <tr>
                            <span style="font-size: 10px"><strong>Sueldo: </strong> {{number_format($record->sueldo,2)}} </span>
                        </tr>
                    </table>
                </td>
                <td width="50%" class="text-left" style="vertical-align: top; padding-top: 10px">
                    <table width="100%" cellpadding="0" cellspancing="0">
                        <tr>
                            <span style="font-size: 10px"><strong>Departamento: </strong>{{$record->departamento}}</span>
                        </tr>
                        <tr>
                            <span style="font-size: 10px"><strong>Cargo: </strong>{{$record->cargo}}</span>
                        </tr>
                        <tr>
                            <span style="font-size: 10px"><strong>Cuenta: </strong>{{$record->tipo_cuenta}} - {{$record->cuenta_banco}}</span>
                        </tr>
                    </table>
                </td>
            </table>

            <table cellpadding="0" cellspacing="0" class="table table-sm align-middle" style="font-size:10px">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 50px;">INGRESOS</th>
                        <th class="text-center" style="width: 50px;">EGRESOS</th>
                    </tr>
                <thead>
                <tbody>                      
                    <tr>
                        <td width="50%" class="text-left">
                            <table width="100%" cellpadding="0" cellspancing="0">
                                @foreach ($tblrecords as $fil => $data)

                                @if ($data->tipo=='P' && $data->persona_id == $record->persona_id)
                                <tr>
                                    <td class="text-left"> {{$etiqueta[$data->rubrosrol_id]}} </td>
                                    <td class="text-right"> {{number_format($data->valor,2)}}</td>
                                </tr>
                                @endif

                                @endforeach
                            </table>
                        </td>
                        <td width="50%" class="text-left">
                            <table width="100%" cellpadding="0" cellspancing="0">
                                @foreach ($tblrecords as $fil => $data)

                                @if ($data->tipo=='D' && $data->persona_id == $record->persona_id)
                                <tr>
                                    <td class="text-left"> {{$etiqueta[$data->rubrosrol_id]}} </td>
                                    <td class="text-right"> {{number_format($data->valor,2)}}</td>
                                </tr>
                                @endif

                                @endforeach
                            </table>
                        </td>
                    </tr>
                </tbody>
                <tfoot>
                <tr>
                    <td width="50%">
                         <table width="100%" cellpadding="0" cellspancing="0">
                         <tr>
                            @foreach ($totales as $fil => $recno)
                            @if ($recno->rubro_total=='TOTING' && $recno->persona_id == $record->persona_id)
                            <td class="text-left"><strong>TOTAL INGRESOS</strong></td>
                            <td class="text-right"> {{number_format($recno->valor,2)}} </td>
                            @endif
                            @endforeach
                         </tr>
                         <tr>
                            <td class="text-center"><strong>RECIBI CONFORME</strong></td>
                         </tr>
                         </table>
                    </td>
                    <td width="50%">
                        <table width="100%" cellpadding="0" cellspancing="0">
                         <tr>
                            @foreach ($totales as $fil => $recno)
                            @if ($recno->rubro_total=='TOTEGR' && $recno->persona_id == $record->persona_id)
                            <td class="text-left"><strong>TOTAL EGRESOS</strong></td>
                            <td class="text-right"> {{number_format($recno->valor,2)}} </td>
                            @endif
                            @endforeach
                         </tr>
                         <tr>
                            @foreach ($totales as $fil => $recno)
                            @if ($recno->rubro_total=='TOTPAG' && $recno->persona_id == $record->persona_id)
                            <td class="text-left"><strong>NETO A RECIBIR</strong></td>
                            <td class="text-right"><strong>{{number_format($recno->valor,2)}}</strong></td>
                            @endif
                            @endforeach
                         </tr>
                         </table>
                    </td>
                    
                </tr>
            </tfoot>
            </table>
        </section>
        <section>
            <table cellpadding="0" cellspacing="0" class="table-sm" width="100%">
            </table>
        </section>
        <div style="page-break-before: always;">
        </div>
    @endforeach

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
