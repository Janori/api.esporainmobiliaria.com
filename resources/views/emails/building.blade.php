<style media="screen">
@import url('https://fonts.googleapis.com/css?family=Ubuntu');
body {
padding: 0;
margin: 0;
}

* {
    font-family: 'Ubuntu', sans-serif !important;
}

html { -webkit-text-size-adjust:none; -ms-text-size-adjust: none;}
@media only screen and (max-device-width: 680px), only screen and (max-width: 680px) {
*[class="table_width_100"] {
    width: 96% !important;
}
*[class="border-right_mob"] {
    border-right: 1px solid #dddddd;
}
*[class="mob_100"] {
    width: 100% !important;
}
*[class="mob_center"] {
    text-align: center !important;
}
*[class="mob_center_bl"] {
    float: none !important;
    display: block !important;
    margin: 0px auto;
}
.iage_footer a {
    text-decoration: none;
    color: #929ca8;
}
img.mob_display_none {
    width: 0px !important;
    height: 0px !important;
    display: none !important;
}
img.mob_width_50 {
    width: 40% !important;
    height: auto !important;
}
}
.table_width_100 {
width: 680px;
}

.label.label-sm {
    font-size: 13px;
    padding: 2px 5px;
}

.label-primary {
    background-color: #337ab7;
}
.label {
    text-shadow: none!important;
    font-size: 14px;
    font-weight: 300;
    padding: 3px 6px;
    color: #fff;
}
.label, .table.table-light>thead>tr>th {
    font-family: "Open Sans",sans-serif;
}
.label-primary {
    background-color: #337ab7;
}
.label {
    display: inline;
    padding: .2em .6em .3em;
    font-size: 75%;
    font-weight: bold;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25em;
}

.first-col {
    font-weight: bold;
    text-align: left;
    font-size: 14px;
}

.second-col {
    text-align: right;
    color: #337ab7;
    font-size: 14px;
    font-weight: lighter;
}

.img-thumbnail {
    max-width: 100%;
    height: auto;
}

</style>
<div id="mailsub" class="notification" align="center">

<table width="100%" border="0" cellspacing="0" cellpadding="0" style="min-width: 320px;"><tr><td align="center" bgcolor="#eff3f8">


<!--[if gte mso 10]>
<table width="680" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<![endif]-->

<table border="0" cellspacing="0" cellpadding="0" class="table_width_100" width="100%" style="max-width: 680px; min-width: 300px;">
    <tr><td>
	<!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"> </div>
	</td></tr>
	<!--content 1 -->
	<tr><td align="center" bgcolor="#fbfcfd">
		<table width="90%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<!-- padding --><div style="height: 60px; line-height: 60px; font-size: 10px;"> </div>
				<div style="line-height: 44px;">
					<font face="Arial, Helvetica, sans-serif" size="5" color="#57697e" style="font-size: 34px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 34px; color: #57697e;">
						Ficha Técnica Inmueble
					</span></font>
				</div>
				<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
			</td></tr>
            <tr><td align="center">
                <h4>IMÁGENES</h4>
				<div style="line-height: 24px;">
					<font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                        <table>
                            @foreach ($building->images as $image)
                                <tr>
                                    <td>
                                        <img src="{{ 'https://esporainmobiliaria.com/api/storage/images/bld/' . $image->path }}" alt="" class="img-thumbnail">
                                    </td>
                                </tr>
                            @endforeach
                        </table>

					</span></font>
				</div>
				<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
			</td></tr>
            <tr><td align="center">
                <h4>UBICACIÓN</h4>
				<div style="line-height: 24px;">
					<font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                        <table>
                            <tr>
                                <td>
                                    <img width="600" class="img-thumbnail" src="https://maps.googleapis.com/maps/api/staticmap?autoscale=false&size=600x300&maptype=roadmap&format=png&visual_refresh=true&markers=size:mid%7Ccolor:0xff0000%7Clabel:1%7C{{ $building->land->location->latitude }},{{ $building->land->location->longitude }}" >
                                </td>
                            </tr>
                        </table>

					</span></font>
				</div>
				<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
			</td></tr>
			<tr><td align="center">
                <h4>CARACTERÍSTICAS</h4>
				<div style="line-height: 24px;">
					<font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                        <table>
                            <tr><td class="first-col">En venta</td><td class="second-col">{{ $building->land->for_sale == '1' ? 'Sí' : 'No' }}</td></tr>
                            <tr><td class="first-col">Precio</td><td class="second-col"><span class="label label-sm label-primary">$ {{ number_format($building->land->price, 2) }} M.N.</span></td></tr>
                            <tr><td class="first-col">Superficie en m<sup>2</sup></td><td class="second-col">{{ $building->land->surface }} m<sup>2</sup></td></tr>
                            <tr><td class="first-col">Fecha de construcción</td><td class="second-col">{{ $building->warehouse->building_date }}</td></tr>
                            <tr><td class="first-col">Costo del predial</td><td class="second-col">$ {{ number_format($building->land->predial_cost, 2) }} M.N.</td></tr>
                            <tr><td class="first-col">Es nuevo</td><td class="second-col">{{ $building->warehouse->is_new == '1' ? 'Sí' : 'No' }}</td></tr>
                            <tr><td class="first-col">Superficio de construcción en m<sup>2</sup></td><td class="second-col">{{ $building->land->surface }} m<sup>2</sup></td></tr>
                            <tr><td class="first-col">Número de baños</td><td class="second-col">{{ $building->office->baths }}</td></tr>
                            <tr><td class="first-col">Número de estacionamientos</td><td class="second-col">{{ $building->office->parkings }}</td></tr>
                            <tr><td class="first-col">Número de cuartos</td><td class="second-col">{{ $building->house->rooms }}</td></tr>
                        </table>

					</span></font>
				</div>
				<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
			</td></tr>
		</table>
	</td></tr>
	<!--content 1 END-->

	<!--content 2 -->
	<tr><td align="center" bgcolor="#ffffff" style="border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #eff2f4;">
		<table width="94%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>

				<div class="mob_100" style="float: left; display: inline-block; width: 33%;">
					<table class="mob_100" width="100%" border="0" cellspacing="0" cellpadding="0" align="left" style="border-collapse: collapse;">
						<tr><td align="center" style="line-height: 14px; padding: 0 27px;">
							<!-- padding --><div style="height: 40px; line-height: 40px; font-size: 10px;"> </div>
							<div style="line-height: 14px;">
								<font face="Arial, Helvetica, sans-serif" size="3" color="#4db3a4" style="font-size: 14px;">
								<strong style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #4db3a4;">
									<a href="#1" target="_blank" style="color: #4db3a4; text-decoration: none;">OBSERVACIONES</a>
								</strong></font>
							</div>
							<!-- padding --><div style="height: 18px; line-height: 18px; font-size: 10px;"> </div>
							<div style="line-height: 21px;">
								<font face="Arial, Helvetica, sans-serif" size="3" color="#98a7b9" style="font-size: 14px;">
								<span style="font-family: Arial, Helvetica, sans-serif; font-size: 14px; color: #98a7b9;">
                                    {{ $building->extra_data }}
								</span></font>
							</div>
						</td></tr>
					</table>
				</div>
			</td></tr>
			<tr><td><!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"> </div></td></tr>
		</table>
	</td></tr>
	<!--content 2 END-->


	<!--footer -->
	<tr><td class="iage_footer" align="center" bgcolor="#ffffff">
		<!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"> </div>

		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td align="center">
				<font face="Arial, Helvetica, sans-serif" size="3" color="#96a5b5" style="font-size: 13px;">
				<span style="font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #96a5b5;">
					{{ date('Y')}} © IT Networks.
				</span></font>
			</td></tr>
		</table>

		<!-- padding --><div style="height: 30px; line-height: 30px; font-size: 10px;"> </div>
	</td></tr>
	<!--footer END-->
	<tr><td>
	<!-- padding --><div style="height: 80px; line-height: 80px; font-size: 10px;"> </div>
	</td></tr>
</table>
<!--[if gte mso 10]>
</td></tr>
</table>
<![endif]-->

</td></tr>
</table>

</div>

<br>
<br>
