@extends('emails.templateEmail')

@section('content')



    <body style="padding: 0px; margin: 0px;">
    <div id="mailsub" class="notification" align="center">

        <table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;">
            <tr>
                <td align="center" bgcolor="#ECEEF1">


                    <table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%"
                           style="max-width: 680px; min-width: 300px;">
                        <tr>
                            <td>
                                <!-- padding -->
                                <div style="height: 80px; line-height: 80px; font-size: 10px;">&nbsp;</div>
                            </td>
                        </tr>
                        <!--header -->
                        <tr>
                            <td align="center" bgcolor="#ffffff">
                                <!-- padding -->
                                <div style="height: 30px; line-height: 30px; font-size: 10px;">&nbsp;</div>
                                <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="left">
                                            <div class="mob_center_bl"
                                                 style="float: left; display: inline-block; width: 115px;">
                                                <table class="mob_center" width="115" border="0" cellspacing="0"
                                                       cellpadding="0" align="left" style="border-collapse: collapse;">
                                                    <tr>
                                                        <td align="left" valign="middle">
                                                            <!-- padding -->
                                                            <div style="height: 20px; line-height: 20px; font-size: 10px;">
                                                                &nbsp;</div>
                                                            <table width="115" border="0" cellspacing="0"
                                                                   cellpadding="0">
                                                                <tr>
                                                                    <td align="left" valign="top" class="mob_center">
                                                                        <a href="{{URL::asset('inicio')}}" target="_blank"
                                                                           style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
                                                                            <font face="Arial, Helvetica, sans-seri; font-size: 13px;"
                                                                                  size="3" color="#596167">
                                                                                <img src="{{URL::asset('http://www.turismoelbosque.com/wp-content/uploads/2015/10/logo11.png')}}"
                                                                                     width="167" height="auto"
                                                                                     alt="Tursimo El Bosque" border="0"
                                                                                     style="display: block;"/></font></a>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <!-- padding -->
                                <div style="height: 50px; line-height: 50px; font-size: 10px;">&nbsp;</div>
                            </td>
                        </tr>
                        <!--header END-->

                        <!--content 1 -->
                        <tr>
                            <td align="center" bgcolor="#fff"
                                style="background-image: url('')}}'); background-size: cover;">
                                <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center">
                                            <!-- padding -->
                                            <div style="height: 60px; line-height: 60px; font-size: 10px;">&nbsp;</div>
                                            <div style="line-height: 44px;">
                                                <font face="Arial, Helvetica, sans-serif" size="5" color="#fff"
                                                      style="font-size: 34px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #fff; text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.5);">
						<strong>Tursimo El Bosque</strong>
					</span></font>
                                            </div>
                                            <!-- padding -->
                                            <div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <div style="line-height: 24px;">
                                                <font face="Arial, Helvetica, sans-serif" size="4" color="#fff"
                                                      style="font-size: 15px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 18px; color: #fff; text-shadow: 0px 1px 2px rgba(0, 0, 0, 0.5);">
						Estamos a su disposición.
					</span></font>
                                            </div>
                                            <!-- padding -->
                                            <div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!--content 1 END-->

                        <!--features -->
                        <tr>
                            <td align="center" bgcolor="#ffffff"
                                style="border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #eff2f4;">
                                <table width="94%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center">
                                            <!-- padding -->
                                            <div style="height: 40px; line-height: 40px; font-size: 10px;">&nbsp;</div>

                                            <!--feature 01 -->
                                            <div class="mob_100" style="display: inline-block;">
                                                <table class="mob_100" width="100%" border="0" cellspacing="0"
                                                       cellpadding="0" align="" style="border-collapse: collapse;">
                                                    <tr>
                                                        <td style="line-height: 14px; padding: 0 27px;">
                                                            <!-- padding -->
                                                            <div style="height: 40px; line-height: 40px; font-size: 10px;">
                                                                <font face="Arial, Helvetica, sans-serif" size="5"
                                                                      color="#6b6b6b"
                                                                      style="font-size: 34px; text-align: center;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 24px; color: #6b6b6b; line-height: 30px;">
                            Tiene una nueva notificación de reserva de la vivienda {{$vivienda->nombre}}
					</span></font>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <!-- padding -->
                                            <div style="height: 80px; line-height: 80px; font-size: 10px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!--END Features-->

                        <!-- Try Content -->
                        <tr>
                            <td align="center" bgcolor="#f8f8f8">
                                <table width="90%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td align="center">
                                            <!-- padding -->
                                            <div style="height: 60px; line-height: 0px; font-size: 10px;">&nbsp;</div>
                                            <div style="line-height: 44px;">
                                                <font face="Arial, Helvetica, sans-serif" size="5" color="#6b6b6b"
                                                      style="font-size: 34px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 24px; color: #6b6b6b; line-height: 30px;">
						Los datos de la reserva son los siguientes:
					</span></font>
                                            </div>
                                            <!-- padding -->
                                            <div style="height: 20px; line-height: 20px; font-size: 10px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align="left">
                                            <div style="line-height: 24px; margin-left: 70px;">
                                                <font face="Arial, Helvetica, sans-serif" size="4" color="#9c9c9c"
                                                      style="font-size: 15px;">

                                        <div class="form-group">
                                            <label class="control-label">Nombre: </label> {{$nombre}}
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Teléfono: </label> {{$telefono}}
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Email: </label> {{$email}}
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Entrada:</label> {{$entrada}}

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Salida:</label> {{$salida}}

                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Mensaje:</label> {{$mensaje}}

                                        </div>

                                           </font>

                                            <!-- padding -->

                                            <div style="height: 50px; line-height: 50px; font-size: 10px;">&nbsp;</div>
                                            </div>
                                        </td>

                                    </tr>
                                    <tr>
                                        <td align="center">
                                            <p>Debe ir a su sección de propietario para aceptar o cancelar la reserva</p>
                                            <div style="line-height: 24px;">
                                                <a href="{{URL::asset('inicio')}}" target="_blank"
                                                   style="color: #596167; font-family: Arial, Helvetica, sans-serif; font-size: 13px;">
                                                    <font face="Arial, Helvetica, sans-seri; font-size: 13px;" size="3"
                                                          color="#596167">
                                                        <img src="{{URL::asset('http://www.turismoelbosque.com/wp-content/uploads/2015/10/logo11.png')}}"
                                                             width="308" height="55" alt="Ir a la web" border="0"
                                                             class="mob_width_80 mob_center_bl"
                                                             style="display: block; margin-top: 20px;"/></font></a>
                                            </div>
                                            <!-- padding -->
                                            <div style="height: 70px; line-height: 70px; font-size: 10px;">&nbsp;</div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <!-- Try Content END-->



@stop