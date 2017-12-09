<!doctype html>
		<html>
			<body>
				<div style="width:100%; margin:0 auto;">
					<div style="width:100%; min-height:101px; background:#F0F0F0; padding: 8px 0 0 0;">
						<div style="float: none; text-align: center;">
							<img src="{{url('/')}}/image1/lgo.png" alt="">
						</div>
					</div>
					<div style="width:100%; border:1px solid #dddddd; margin: 5px 0; ">
						@if(@$fname && @$lname)
						<h1 style="font-family:\'Open Sans\', sans-serif; font-size:19px; font-weight:500; color:#0455ca; padding:0 10px; margin:5px 0 6px 0;"> Dear {{@$fname}} {{@$lname}}</h1>
						@endif
						<div style="display:block;overflow:hidden; margin: 15px 0px 15px 0px; padding:0 10px;">
							<div style="font-family:\'Open Sans\', sans-serif; font-size:18px; font-weight:500; color:#424242; padding:8px 8px;
								background:#f7f8f9; overflow:hidden; display:block;">
								<p style="margin:0; line-height:22px; text-align:left;">This is your username : {{@$user_name}} <br>
								This is your password : {{@$password}} 
								</p>
							</div>
						</div>
						<p style="font-family:\'Open Sans\', sans-serif; font-size:14px; padding:0 10px; font-weight:bold; color:#363839;margin: 0px 0px 6px 0px;">Thank you</p>
						<p style="font-family:\'Open Sans\', sans-serif; font-size:14px; padding:0 10px; font-weight:bold; color:#363839;margin: 0px 0px 10px 0px;">Team MsEcommerce</p>
					</div>
					<div style="width:100%; margin:0 auto; min-height:20px; margin:15px 0; background:#1f2023; border:1px solid #1f2023;">
						<p style="font-family:\'Open Sans\', sans-serif; text-align:center; margin:9px 0; font-size:14px; color:#ffffff !important;">Copyright © {{date('Y')}} MsEcommerce.com</p>
					</div>
				</div>
			</body>
		</html>