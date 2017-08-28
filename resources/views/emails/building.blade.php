<style media="screen">
body {
padding: 0;
margin: 0;
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
				<div style="line-height: 24px;">
					<font face="Arial, Helvetica, sans-serif" size="4" color="#57697e" style="font-size: 15px;">
					<span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #57697e;">
                        <table>
                            <div class="row" *ngFor="let key of building.land | keys">
                                <div class="col-sm-6" style="font-weight:bold;font-size: 13px;" *ngIf="['id', 'location', 'location_id'].indexOf(key) == -1">
                                    <p [innerHTML]="keysEnum.land[key]"></p>
                                </div>
                                <div class="col-sm-6" style="text-align: right; color: #5b9bd1;" *ngIf="['id', 'location', 'location_id'].indexOf(key) == -1 && key != 'price'">
                                    <p [innerHTML]="response(key, building.land[key])"></p>
                                </div>

                                <div class="col-sm-6" style="text-align: right;" *ngIf="['id', 'location', 'location_id'].indexOf(key) == -1 && key == 'price'">
                                    <span class="label label-sm label-primary" [innerHTML]="response(key, building.land[key])"></span>
                                </div>
                            </div>
                            <tr><td>En venta</td></td>{{ $building->land->for_sale == '1' ? 'Sí' : 'No' }}</td></tr>
                            <tr><td>Precio</td></td>$ {{ number_format($building->land->price, 2) }} M.N.</td></tr>
                            <tr><td>Superficio en m<sup>2</sup></td></td>{{ $building->land->surface }} m<sup>2</sup></td></tr>
                            <tr><td>Fecha de construcción</td></td>{{ $building->land->building_date }}</td></tr>
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
