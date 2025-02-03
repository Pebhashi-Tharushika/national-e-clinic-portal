<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>National E Clinic Portal</title>

	<!-- favicon -->
	<link rel="icon" href="/national-e-clinic-portal/images/logo-v.png" type="image/png">

	<!-- to add icons from boxicons -->
	<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

	<link rel="stylesheet" href="/national-e-clinic-portal/style/back-to-home.css">
	<link rel="stylesheet" href="/national-e-clinic-portal/style/see-clinic-details.css">

	<script defer src="/national-e-clinic-portal/js/see-clinic-details.js"></script>

</head>

<body>

	<?php
	include_once 'back-to-home.php';
	?>

	<section id="clinic-details-container">
		<div id="clinic-details-title-and-intro">
			<div id="title-intro-container">
				<div id="clinic-details-title">
					<h1>Explore Clinics </h1>
					<h1>The Way You Want</h1>
				</div>
				<div id="clinic-details-intro">
					<ul>
						<li><i class='bx bxs-check-circle'></i>Find clinics that fit your needs anywhere in Sri Lanka.
						</li>
						<li><i class='bx bxs-check-circle'></i>Search specialized clinics by disease.</li>
						<li><i class='bx bxs-check-circle'></i>Discover nearby options for easy access.</li>
						<li><i class='bx bxs-check-circle'></i>Manage your schedule with suitable dates and times.</li>
						<li><i class='bx bxs-check-circle'></i>Stay updated with real-time information on locations,
							dates and
							times.</li>
					</ul>
				</div>
			</div>
		</div>


	</section>

	<section id="clinic-detail-selections">

		<div id="province-selection">
			<div id="select-province-title">
				<h1>Select Your Province</h1>
				<i class='bx bxs-chevrons-down fade-down'></i>
			</div>

			<div id="sl-map">
				<svg id="sri-lanka" xml:space="preserve" viewBox="138.5643178410795 0 504.9403298350825 599.8812"
					y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg"
					version="1.1" width="504.9403298350825" height="599.8812">
					<g id="Sri_Lanka">
						<path
							d="M420.522,146.676l0.037,2.177l1.627,1.151l-0.011,0.011l-1.46,1.359l-1.292,1.54l0.011,0.006l2.151,1.698&#10;&#9;&#9;l2.318-0.18l1.894-1.777l1.404-2.47l0.914-2.284l0.022,0.011l4.947,5.995l4.39,7.562l1.794,1.872l2.507,0.733l2.006,1.624&#10;&#9;&#9;l2.942,7.155l0.746,0.784l0.791,0.84l0.011,0.006l3.365,1.533l1.683,3.602l1.928,7.243l0.345-1.33l0.446-0.519l0.747,0.169&#10;&#9;&#9;l0.011,0.006l1.326,0.727l-0.401,1.33l3.811,4.171l1.27,2.068l-0.011,2.497l-1.003,1.003l-1.426,0.659l-1.304,1.516l0.022-0.011&#10;&#9;&#9;l0.992-0.254l1.025-0.265l0.256-0.141l0.512-0.276l0.011,0.011l2.964,6.469l0.435,3.369l-3.399,0.552h-0.011l0.702-2.231&#10;&#9;&#9;l-0.914-1.786l-1.515-0.259l-1.081,2.383l0.368,1.848l0.969,1.313l0.535,1.403l-1.014,2.135l-0.802-0.614l-1.493-1.166l-2.373-1.47&#10;&#9;&#9;l-2.396-0.552l-2.284,0.969l-1.772,2.389l0.624,1.251l2.117-0.327l2.853-2.361l1.961,2.09l1.772,2.507l2.139,2.09l3.009,0.867&#10;&#9;&#9;l6.296-0.124l2.128-1.352l-1.404-3.245l3.599-1.651l1.426-0.439l1.515,0.107l0.011,0.011l1.66,0.958l1.515,1.622l1.137,1.893&#10;&#9;&#9;l0.969,5.543l2.139,7.13l0.067,1.858l0.067,1.864l-1.738-1.222l-1.816-3.672l-1.593-0.777l-0.056,1.003l0.658,4.494l0.056,0.343&#10;&#9;&#9;l0.746,1.723l0.914,0.434l0.836,0.394h0.022h1.85l1.471,0.664l0.869,5.293l1.048,3.671l0.178,0.608l0.29,2.246v0.011l0.423,1.436&#10;&#9;&#9;l2.853,9.665l1.081,6.298L490,269.322v0.017l-1.382-5.701l-0.201-0.805l-2.084-5.775h-1.003l-0.167,4.385l0.167,1.379l-0.1-0.045&#10;&#9;&#9;l-0.1,0.394v0.011v0.687l0.201,0.833l0.457,0.54l1.159,0.354l0.011,0.006l0.234,0.433l1.114,2.898l2.407,1.767h0.011l2.295-0.191&#10;&#9;&#9;l0.802-2.971h0.836l0.869,1.587l0.234,0.428l1.125,4.991l1.148,1.919l1.526,1.677l0.981,1.632l1.694,3.905l0.669-0.675l0.88-0.664&#10;&#9;&#9;l0.401-0.636l0.602,1.288l-0.602,0.686l0.301,0.495l0.267,0.326l0.045,0.084l0.156,0.276l0.089,0.619l0.011-0.011l0.68-0.563&#10;&#9;&#9;l1.404-0.675l0.713-0.551v0.011l0.323,0.776l0.39,0.945l-0.29,1.12l-0.479,1.114l0.022,0.861l0.034,0.833l0.958,1.856l1.694,1.299&#10;&#9;&#9;l1.103,0.849l1.003,1.659l-0.635,0.039l-0.323,0.219l-0.412,0.281l-0.256,0.163l-0.256,0.158l-0.401,1.508l-0.401,1.507&#10;&#9;&#9;l1.605,4.713l0.869,1.001l1.961,2.261h0.022l2.897-0.529h0.936l0.947,2.885l1.081,1.783l0.334,0.551l5.906,6.185l1.905,3.019&#10;&#9;&#9;l0.334,2.671l-3.031,0.917l-0.011,0.006l-1.404-0.956l-3.365-4.29l-1.76-1.524l-2.273-0.838h-0.022l-0.234,0.023l-1.616,0.141&#10;&#9;&#9;l-1.426,1.462l-0.97,3.064l1.638,0.748l1.582,0.225l1.359-0.506l1.025-1.411l1.616,0.607l1.482,0.742l0.512,0.607l0.345,0.422&#10;&#9;&#9;l-0.212,1.484l1.816,1.704l1.816,1.703l1.426,1.642l1.493,2.496l-0.011,0.006l-0.702,0.815l-0.178,0.793l0.234,0.95l0.657,1.304&#10;&#9;&#9;l0.847-1.04l-0.513-1.878v-0.011l1.616,0.573l3.176,2.355l0.758,1.102l2.518,6.436l-0.156,0.275l-0.78,3.496l0.111,0.382&#10;&#9;&#9;l0.022,0.056l0.646,1.337l0.156,0.539l-0.535,0.95l-0.981,0.759l-0.59,0.843l0.702,1.225l0.669,0.882l0.234,0.691l0.033,0.09&#10;&#9;&#9;l0.401,0.787l1.003,0.893l-1.471,1.062l0.134,0.528l0.134,0.534l1.103,0.23l1.103-1.416h0.847l0.011,0.006l1.047,5.568&#10;&#9;&#9;l-0.033,2.051h0.022h0.936v-0.051l0.111-1.933l0.334-1.91l0.579-1.63l0.847-1.158v-0.938l-0.078-0.219l-0.301-0.865l0.245-0.433&#10;&#9;&#9;l0.758,0.32l1.226,1.191l0.424,1.09l0.312,2.927l2.106,3.354l3.421,11.747l-0.646,32.454l0.334,2.184l1.404,4.879l0.223,2.874&#10;&#9;&#9;l-0.78,5.484l-6.307,21.893l-0.357,2.256l-0.134,2.985l-0.468,2.491l-1.972,3.843l-0.435,1.717l-0.78,2.356l-2.652,4.157&#10;&#9;&#9;l-1.248,1.952l0.936,3.354l-1.504,3.982l-8.708,13.803l-1.218-0.406l-3.326-1.043l-2.278-2.603l-1.755-0.242l-1.571-0.103&#10;&#9;&#9;l-4.09-5.046l3.566-50.589l-0.679-2.727l-1.642-2.359l-0.014-2.666l-0.948-2.652l0.637-2.723l0.269-2.592l-4.047-2.442&#10;&#9;&#9;l-4.882-1.262l-0.708-0.627l-0.849-0.506h-1.019l-1.104-0.485l-1.061-1.893l-0.552-2.139l-1.769-3.223l1.599-4.282l2.859-3.391&#10;&#9;&#9;l2.222-1.754l-2.972-4.123l-0.396-2.967l-1.91-3.345l-3.028-2.636l-0.552-2.661l0.198-3.296l-1.627-7.27l0.269-1.855l-0.906-0.16&#10;&#9;&#9;l-0.863-0.525l2.024-3.147l-2.689-0.732l-3.425,1.837l-1.656,0.578l-1.514,0.678l-0.509,1.292l-0.934,1.477l-1.896,0.492&#10;&#9;&#9;l-1.401,0.107l0.028,1.805l0.75,1.627l0.156,1.623l-0.623,1.359l-0.948,1.149l-0.637,0.97l-2.774,1.541l-3.396-0.153l0.014,5.3&#10;&#9;&#9;l0.722,5.15l-2.547,1.865l-2.774,0.966l-1.203-2.243l-1.076-2.671l-0.481-2.475l-1.231-2.49l-0.948-1.602l-0.566-1.227&#10;&#9;&#9;l-1.684-0.321l-1.189,0.289l-2.052-2.03l-1.514-3.232l-0.892-6.075l-0.552-1.72l-0.41-1.702l0.382-1.242l0.764-1.424l1.443-6.712&#10;&#9;&#9;l-0.524-6.905l-6.085-1.324l-6.722,3.776l-2.915,2.698l-1.656,0.639l-1.373,0.318l-2.491,0.878l-3.368-5.635l-1.09-3.312&#10;&#9;&#9;l-0.184-2.252l-0.892-1.967l-2.066-1.274l-0.382-0.364l1.316-6.539l-0.297-2.66l-0.991-3.113l0.099-2.31l2.576-0.007l5.109-0.493&#10;&#9;&#9;l2.505-0.443l4.981,1.921l4.047,4.073l6.623,2.06l3.227,1.849l2.675,0.321l0.326-1.424l0.637-1.617l0.877-0.921l0.75-1.482&#10;&#9;&#9;l-0.424-3.263l0.623-3.11l-1.939-10.691l1.203-10.639l1.033-4.015l3.071-2.075l3.92-0.546l4.967,0.657l1.259-0.096l-1.132-5.151&#10;&#9;&#9;l-2.292-4.994l-1.005-5.091l1.104-21.811l-0.722-7.214l-2.123,0.014l-1.712-0.004l-1.245,1.344l-0.906,1.652l-1.033,0.776&#10;&#9;&#9;l-0.948,0.826l-0.863,3.617l-0.694,1.323l-1.939,4.543l-3.439,0.783l-0.665-0.225l-0.538-0.386l1.585-1.001l0.736-1.723&#10;&#9;&#9;l-0.481-2.627l0.057-1.784l-0.212-1.759l-0.977-1.383l-1.726,0.132l-2.42-1.244l-2.208-1.705l-2.278-1.294l-2.448-0.004&#10;&#9;&#9;l-10.373-2.542l-5.774,0.568l-1.712-1.723l-0.566-2.882l-2.094-1.652l-2.222-0.858l-1.599-2.374l-2.052,0.601l2.972-10.631&#10;&#9;&#9;l0.311-1.742l0.566-1.67l1.684-1.667l1.953-1.266l1.132-2.042l-0.92-2.128l-1.585-1.227l-1.231-1.563l-1.925-4.597l-3.623-5.406&#10;&#9;&#9;l-0.566-3.303l-1.458-1.424l-1.16-1.324l-0.113-2.827l2.123-4.974l-1.047-2.888l-2.533-5.569l-0.085-5.953l2.321-3.433l1.599-3.594&#10;&#9;&#9;l-1.302-0.992l-1.104-1.49l-2.108-2.32l-5.958-4.175l-3.495-1.984l-4.019-0.089l-3.863,1.586l0.608-2.424l1.132-1.973l5.378-2.514&#10;&#9;&#9;l6.34-0.824l2.618-0.759l2.378-1.411l2.632-0.752l2.165-0.956L420.522,146.676z M532.231,330.512l-0.234-1.45l-0.535-1.124&#10;&#9;&#9;l-0.657-1.383l-0.446-1.355l0.067-1.434l0.423-1.271l0.178-1.344l-0.669-1.602v-0.017l1.761,1.72l1.682,3.986l1.237,1.844&#10;&#9;&#9;l0.301,0.798l1.27,3.429l3.332,5.306l1.538,2.445l2.318,12.044v0.011l-0.089,2.754l-2.028,1.68l-1.928-1.523l-0.591-0.624&#10;&#9;&#9;l-0.279-0.287l-0.089-0.686l-0.1-0.68l0.022-0.287l0.568-8.694l-0.401-3.001l-1.504-1.282l-0.568-1.231L532.231,330.512z"
							class="st0" title="Eastern Province" />
						<text transform="matrix(1 0 0 1 470 340)">Eastern</text>


						<path
							d="M379.864,82.057l16.214,13.194l0.145,0.248l0.958,1.615l1.538,1.92l2.942,2.778l1.872,2.433l-1.66,0.875&#10;&#9;&#9;l-0.011,0.006l-0.936-0.423l-0.112-0.051l-0.022-0.006l-1.437-1.863l-0.791-0.407l-0.011-0.011l-2.474-0.407l-1.081,0.327&#10;&#9;&#9;l0.535,1.106l0.178,0.35l7.109,6.65l2.775,1.53l0.011,0.006l-1.103-1.722l-0.669-1.569l0.345-1.168l1.894-0.446l0.891,0.604&#10;&#9;&#9;l1.449,4.301l1.326,2.647l5.204,10.43l-1.048-0.384l-2.897-1.078l-1.816-0.034l-0.769,1.975l1.07,0.502l2.229,0.367l1.983,1.253&#10;&#9;&#9;l0.022,0.169l0.29,3.002h0.022h0.914l0.457-0.796l0.412-0.344l0.468-0.226l0.624-0.44v0.011l0.702,2.754l0.078,0.344l1.939,4.44&#10;&#9;&#9;l2.596,3.983l2.641,1.726l0.201,0.163l0.312,0.265l-0.011,0.97l-0.635,0.976l-1.27,0.457l-0.368-0.406l-1.504-2.426l-1.638-0.869&#10;&#9;&#9;l-3.755-0.97l-2.184-1.004l1.003,1.399l0.557,0.778l4.947,4.648l0.008,0.463l-0.01,0.005l-2.165,0.956l-2.632,0.752l-2.378,1.411&#10;&#9;&#9;l-2.618,0.759l-6.34,0.824l-5.378,2.514l-1.132,1.973l-0.608,2.424l-3.764,0.716l-3.594,1.028l-3.977,2.789l-10.189,0.354&#10;&#9;&#9;l0.255,3.04l3.566,1.239l2.519,3.265l1.146,3.587l-3.255,2.585l-1.925,2.359l-1.656,2.549l-2.986,3.501l-3.467,3.128l-3.651,2.795&#10;&#9;&#9;l-4.359,0.032l-2.321-1.661l-2.533-1.349l-4.175,1.922l-5.392,7.025l-2.547,5.968l-2.434,1.063l-2.094,3.789l-1.33-0.079&#10;&#9;&#9;l-1.429-0.401l-2.887-1.546l-1.458-2.934l-0.509-1.878l-0.877-1.707l-2.024-0.927l-2.08-0.716l-1.401-3.9l-0.057-4.498&#10;&#9;&#9;l-13.316,3.504l-6.722-0.021l-6.099-2.491l1.09,8.116l-0.283,12.833l-1.316-0.154l-1.132-0.562l-3.651-2.061l-3.509-1.492&#10;&#9;&#9;l-4.047-0.376l-3.609-1.381l-1.57-0.912l0.511-0.552l0.223-0.682l1.359-4.237l0.189-0.18l0.1-0.096l0.301-1.24l1.27-2.773&#10;&#9;&#9;l1.215-13.482l-3.298-8.603l0.267-1.494l0.245-9.811v-0.13l-0.334-3.282l-0.401-1.613l-0.713-1.218l-0.557-1.387l1.27-0.688&#10;&#9;&#9;l1.839-0.344l1.215-0.372l7.945-7.192l4.145-2.048l1.727-1.517l0.914-3.374l1.638-3.47l0.936-4.824l4.401-11.433l0.156-0.632&#10;&#9;&#9;l0.412-1.671l0.847-3.381v-8.061l0.301-1.18l-0.267-0.796l-1.604-0.311l-3.777-1.976l-1.471-1.378l-0.925-2.609l-0.156-0.474&#10;&#9;&#9;l-0.658-3.252l-0.067-1.847l1.638-1.734l3.031-1.519l3.365-1.079l2.763-0.412l1.237-0.638l3.008-4.01l0.346-0.26l0.524-0.407&#10;&#9;&#9;l1.003-0.599l1.237-0.463l1.571-0.249l-1.304-2.418l-0.78-1.062l-0.791-1.062l-2.017-2l-2.663-2l-10.129-5.978l-2.039-2.548&#10;&#9;&#9;l4.413,0.141L310,64.219l8.246,4.814l7.867,1.989l2.073,1.333l3.242,2.847l0.802,1.503l-1.671,0.859l0.368,0.949l0.49,0.949&#10;&#9;&#9;l-0.858,0.938l0.011,0.006l2.864,1.937l6.764-1.661l12.368-4.931l3.332,0.322l7.298,2.022l8.613,3.897l6.496,1.254h0.022&#10;&#9;&#9;l-9.315-6.417l-3.209-1.491l-2.853-0.621l-0.423-0.198l-0.412-0.198l-2.474-1.887l-0.936-0.554l-0.936-0.147l-1.125,0.057&#10;&#9;&#9;l-1.694,0.09l-1.07,0.412l-0.156,0.237l-0.301,0.503l-0.535,0.277l-1.816-1.35l-0.724-0.124l-4.446,0.119l-1.27-0.373l-9.739-8.475&#10;&#9;&#9;l-4.178-2.718h-0.011l-1.494-0.662l-7.041-3.096l-2.541-1.475l-1.705-0.023l0.323,3.379l0.947,0.994l1.471,1.125l0.869,1.373&#10;&#9;&#9;l-0.869,1.774l-1.036,0.316l-1.003-0.542l-0.914-0.768l-2.63-1.373l-5.115-4.481l-2.942-1.266l0.011,0.011l1.493,1.65l2.697,2.34&#10;&#9;&#9;l1.493,1.695l-3.32-0.644l-3.276-1.373l-6.585-3.679l-5.248-4.148l-3.12-1.108l-0.312-0.192l-1.181-0.769L288.572,49l-0.167,0.984&#10;&#9;&#9;l-1.504-1.034l-0.568-1.34l-0.267-1.6l-0.535-1.809l-0.903-1.543l-0.535-0.701l-1.404-1.843l-0.903-1.6l2.964-1.493l5.393-5.015&#10;&#9;&#9;l2.429-1.086h0.011l10.697,0.95l5.582-0.628l2.039,0.237l0.802,1.855l-0.134,2.912l0.401,1.012l1.17,0.384l1.137,0.164l3.276,0.848&#10;&#9;&#9;l0.691,0.373l0.613,1.221l1.471-0.051l1.159-0.356l0.446-0.136l0.669-0.096l0.468-0.068l0.011,0.006l1.059,0.622l0.457,0.266&#10;&#9;&#9;l3.833,4.195l5.523,6.037l6.556,7.165l4.257,2.69l9.872,4.576l0.312,0.137v-1.028l-4.97-2.526l-12.034-9.895l-9.861-11.435&#10;&#9;&#9;l-5.014-2.702l-7.856-1.871l-2.073-1.493l-0.267-2.109l2.875-1.255l0.936-0.158l2.853-0.481L325.21,30l2.73,0.514l1.894,1.34&#10;&#9;&#9;l1.259,4.546l1.259,1.9l17.929,21.161l2.641,1.95l5.348,3.068L379.864,82.057z M257.294,75.75l-1.092,1.051l-1.114,1.051&#10;&#9;&#9;l-3.454,0.203l-3.209-1.068l-1.404-1.751v-5.689l0.401-1.458l0.903,0.187l0.936,1.169l0.568,1.475l2.362,0.746l2.819,0.215&#10;&#9;&#9;l0.702,0.514L257.294,75.75z M279.892,59.461l-2.117-1.543l-2.117-3.182l-3.321-6.652l1.515-2.38l0.345-3.047l0.858-2.47&#10;&#9;&#9;l2.986-0.645l1.582,0.481l0.022,0.006l0.134,1.17l-0.535,1.634l-0.368,1.888l0.056,1.905l0.201,1.52l0.011,0.09l0.123,0.305&#10;&#9;&#9;l0.468,1.102l0.624,0.718l0.49,0.565l0.579,0.147l2.652-0.147l0.446,0.413l0.201,2.085l0.334,0.865l1.56,0.989l2.117,0.91&#10;&#9;&#9;l1.772,1.012l0.145,0.316l0.468,0.995l-0.947,0.983l-1.805,0.011l-1.939-0.605l-1.371-0.865l-0.969-0.237l-2.463,1.458&#10;&#9;&#9;l-1.727,0.203H279.892z M255.01,134.654l-1.527-0.604l-0.68-1.332l0.435-1.331l1.772-0.609h6.117l2.708,0.7l2.797,0.722&#10;&#9;&#9;l5.839,2.234l5.571,3.25l4.68,4.547l-0.011-0.006l-2.24-0.468l-3.945-1.963l-2.318-0.406l3.555,4.062l2.797,3.204l1.226,2.2&#10;&#9;&#9;l-3.276-0.417l-2.14-1.658l-1.471-1.805l-1.103-0.857l-1.415-0.722l-5.638-5.043l-2.797-1.253l-2.797-1.253l-2.05-0.559&#10;&#9;&#9;l-1.092-0.299L255.01,134.654z"
							class="st0" title="Northern Province" />
						<text transform="matrix(1 0 0 1 330 140)">Northern</text>

						<path
							d="M270.587,383.606l-5.916-43.33l-0.836-1.787l0.568-0.607l0.423-0.062l0.981,0.669l0.223-2.389l0.68-2.771&#10;&#9;&#9;l0.167-1.327l0.167-1.332l-0.769-2.08l-1.036-1.906l-0.201-1.265l-0.201-1.265l0.011-5.094l-3.153-15.493l-0.368-1.788&#10;&#9;&#9;l-1.627-3.403l-1.382-7.149l-2.24-5.642l-3.443-15.592v-4.429l0.557,0.253l0.033,0.039l0.045,0.039v0.141l0.301,0.473l0.49-2.572&#10;&#9;&#9;l-0.724-8.173l-0.702-2.477l2.251-1.486l2.128-2.753l1.538-3.136l0.613-2.635l0.624-1.723l4.045-6.391l-0.045,0.107l-2.039,4.826&#10;&#9;&#9;l-2.585,4.6l0.568,1.12l0.145,0.276l1.014,1.013l1.326,0.529l1.616-0.011l-1.326,3.76l-1.382,2.758l-0.602,0.478l-0.635,0.068&#10;&#9;&#9;l-0.501,0.388l-0.223,1.469l0.123,3.27l-0.123,1.019l-2.318,7.412l0.089,1.373l0.178,2.746l2.396,2.853l0.68,0.81l-2.741,5.739&#10;&#9;&#9;l4.368,3.179l6.351,0.501l3.231-2.29l-0.613-2.464l-1.036-1.93l-0.401-0.737l-0.49-0.608l-1.215-1.53l-1.371-0.878l-0.401-1.497&#10;&#9;&#9;l4.613-8.813l-0.178-1.598l-0.591-1.182l-0.68-0.991l-0.423-1.036l-0.112-1.666l0.156-2.871l-0.044-1.182v-0.034l-0.078-0.225&#10;&#9;&#9;l-0.368-0.985l-0.223-0.203l-0.267-0.253l-0.267-0.563l0.267-1.548l0.646-1.312l1.794-2.353l0.368-1.531l0.29-2.894l1.281-5.794&#10;&#9;&#9;l1.304-13.516l0.836-1.538l0.903-0.76l0.691-0.918l0.29-2.022v-5.763l0.791-2.828l1.861-1.82l2.206-1.504l1.272-1.375l1.57,0.912&#10;&#9;&#9;l3.609,1.381l4.047,0.376l3.509,1.492l3.651,2.061l0.778,5.716l-2.491,5.297l-4.274,3.505l-0.184,0.973l-0.623,1.241l-2.307,1.066&#10;&#9;&#9;l-1.5,3.429l2.01,3.88l3.41,13.951l0.849,2.456l2.844-0.014l2.307-1.051l2.448,1.841l2.774-0.1l2.024,1.623l1.528,1.98l2.958,1.648&#10;&#9;&#9;l12.623,5.808l2.703,0.679l2.618,1.054l2.052,1.479l2.533,0.375l4.543,1.755l4.118,3.352l2.236,2.258l2.477,1.536l2.576-0.086&#10;&#9;&#9;l2.066,1.701l0.043,1.729l-0.241,1.743l0.396,2.951l-0.184,2.515l0.255,2.404l1.91,0.804l2.208,0.161l1.132,1.904l0.354,2.315&#10;&#9;&#9;l1.288,3.204l0.679,3.268l-0.524,4.8l3.481,3.35l-0.637,2.257l0.354,2.421l1.217,0.686l1.033,0.289l0.977,2.149l1.359,2.285&#10;&#9;&#9;l0.934,2.371l0.042,2.381l0.495,0.346l0.694,0.993l0.396,4.616l0.764,4.276l2.505,2.456l-0.057,1.62l-0.396,1.631l0.028,1.256&#10;&#9;&#9;l-0.495,1.185l-1.939,1.774l-0.34,2.916l1.373,2.769l0.835,1.381l0.693,1.456l0.382,1.727l-0.283,1.67l-0.764,1.042l-0.071,1.427&#10;&#9;&#9;l-1.642,0.76l-1.613,0.417l1.104,1.752l0.821,1.877l-1.472,0.706l-1.967-0.342l-2.009,1.12l0.212,1.541l-0.198,1.434l-2.349-0.178&#10;&#9;&#9;l-2.123-1.52l-1.967,0.004l-0.439,2.761l-0.58,0.753l-0.467,0.81l0.113,0.902l0.226,0.642l-2.462,0.724l-2.83-0.31l-1.26-2.661&#10;&#9;&#9;l-1.995-2.069l-3.269-0.446l-3.014,1.206l-0.481,2.618l0.156,2.832l-0.453,1.63l-0.991,1.334l-1.458,0.061l-6.694,1.494&#10;&#9;&#9;l-3.212,1.502l-3,2.158l-2.83,2.529l-2.788,1.623l-2.392-1.755l-3.41-3.891l-0.793-1.138l-0.382-1.177l-1.245-1.37l-3.807,0.681&#10;&#9;&#9;l-3.354,2.376l-3.962,1.181l-3.778-2.672l-3.283,0.139l-5.222,4.098l-2.915,1.145l-2.392-0.927l-2.01,1.252l-1.613-0.196&#10;&#9;&#9;l-1.061-1.188l-2.646,0.339l-2.547,0.671L270.587,383.606z"
							class="st0" title="North Western Province" />
						<text transform="matrix(1 0 0 1 270 320)">North Western</text>

						<path
							d="M273.518,426.525l1.359-3.272l0.357-1.572l-0.033-1.6v-0.028l-6.552-23.3l0.903-3.42l-0.045,2.106l0.513,1.325&#10;&#9;&#9;l0.735,1.022l0.646,1.207l1.315,4.621l0.646,1.112h0.847l0.201-1.319l0.39-0.556l0.345-0.09h0.011l0.078,0.073l-0.033-4.217v-0.028&#10;&#9;&#9;l-0.301-1.848l-0.691-1.522l-0.646-0.444l-1.805-0.393l-0.802-0.539l-0.089-0.191l-0.49-0.994l0.223-1.095l0.524-1.022l0.279-0.977&#10;&#9;&#9;l-0.814-5.96l3.26,0.164l2.547-0.671l2.646-0.339l1.061,1.188l1.613,0.196l2.01-1.252l2.392,0.927l2.915-1.145l5.222-4.098&#10;&#9;&#9;l3.283-0.139l3.778,2.672l3.962-1.181l3.354-2.376l3.807-0.681l1.245,1.37l0.382,1.177l0.793,1.138l3.41,3.891l2.392,1.755&#10;&#9;&#9;l0.226,1.833l-1.344,1.07l-0.368,4.743l-1.783,1.68l-2.165,1.123l-0.58,3.908l1.67,3.458l3.34-0.795l2.887,0.845l-1.033,2.342&#10;&#9;&#9;l-1.981,1.373l-1.741,4.018l-0.707,4.018l2.038,6.548l0.028,1.258l-0.41,1.133l2.972,0.2l2.363,1.205l0.425,2.509l-1.826,1.711&#10;&#9;&#9;l0.184,1.333l0.071,1.344l-1.755,2.149l-1.486,2.359l-0.58,1.921l-0.708,1.636l3.368,3.581l-3.014,2.704l0.453,2.84l2.392,6.327&#10;&#9;&#9;l-0.198,2.202l0.877,2.593l1.33,2.757l4.175,4.057l0.807,4.018l1.514,1.421l1.91,0.741l3.057,2.796l1.981,3.793l-2.066,0.794&#10;&#9;&#9;l0.722,2.34l5.788,8.151l4.953,8.616l-4.882,1.118l-4.783,2.958l-2.533,1.118v2.951l1.033,2.997l-0.269,2.762l-2.137-1.712&#10;&#9;&#9;l-2.109-2.036l-4.047-3.115l-4.161,0.356l-3.736,2.1l-5.929-1.129l-2.278-1.531l-2.208-1.944l-2.717-1.189l-2.505-0.509&#10;&#9;&#9;l-5.024-2.335l-0.693-1.178l-1.005-0.965l-1.387,0.552l-0.892,0.616l-0.793-0.737l-0.736-1.036l-0.951-0.21l-0.579-2.366&#10;&#9;&#9;l-0.29-0.23l-0.591-0.359l-0.613-0.538l-0.379-0.757l0.156-0.807l0.669-0.196l0.702,0.078h0.011l0.334-0.017l-1.047-7.228&#10;&#9;&#9;l-0.089-0.578l-2.853-7.335l-6.625-17.016l-5.109-13.125l-1.861-10.415l-0.178-1.033v-9.923L273.518,426.525z"
							class="st0" title="Western Province" />
						<text transform="matrix(1 0 0 1 274 435)">Western</text>

						<path
							d="M346.867,564.482l-0.876-0.128l-0.657-0.291l-0.457-0.65l-0.579-0.644l-1.07-0.297l-0.635,0.224l-0.501,0.448&#10;&#9;&#9;l-0.535,0.381l-0.713-0.022l-0.245-0.202l-0.223-0.196l-0.869-1.238l-0.423-0.258l-0.111-0.067v-0.011l-0.969-0.342l-5.85-2.101&#10;&#9;&#9;l-2.396-0.493l-1.705-0.359l-2.975-2.392l-0.668-0.325l-1.315-0.639l-0.022-0.011l-1.003,1.025l-2.552-2.062l-11.154-11.839&#10;&#9;&#9;l-0.914-0.717l-0.011-0.006l-0.1-0.129l-0.312-0.375l-0.167-0.583l0.045-1.166l-0.345-0.605l-0.468-0.611l-1.237-1.62&#10;&#9;&#9;l-6.318-13.361l-0.267-1.278v-0.011l0.033-1.143l0.034-1.143v-0.011l-0.234-0.695l-1.137-2.371l-1.159-6.43l-2.518-4.519&#10;&#9;&#9;l-1.582-6.464l0.951,0.21l0.736,1.036l0.793,0.737l0.892-0.616l1.387-0.552l1.005,0.965l0.693,1.178l5.024,2.335l2.505,0.509&#10;&#9;&#9;l2.717,1.189l2.208,1.944l2.278,1.531l5.929,1.129l3.736-2.1l4.161-0.356l4.047,3.115l2.109,2.036l2.137,1.712l0.269-2.762&#10;&#9;&#9;l-1.033-2.997v-2.951l2.533-1.118l4.783-2.958l4.882-1.118l1.67,1.73l1.868,1.581l2.307,0.94l2.038,0.05l4.26,2.1l2.208-0.071&#10;&#9;&#9;l1.175,1.702l2.675-0.384l2.689-0.623l0.948-2.232l2.335-0.018l6.014-0.794l1.981,3.652l-0.906,2.449l2.462,0.438l3.283-0.552&#10;&#9;&#9;l1.528,1.894l-0.113,1.292l1.755,1.306l-0.722,0.737v1.313l7.826,1.499l10.047,3.659l2.632,0.406l2.604-0.623l2.618-0.253&#10;&#9;&#9;l2.08,1.637l1.599,1.854l5.024,1.018l2.873,0.95l0.693-2.42l-1.274-3.506l-2.519-2.812l3.368-2.21l3.453-1.869l3.863-1.26&#10;&#9;&#9;l2.972-2.253l-1.316-3.086l0.665-3.126l1.727,0.014l1.854-0.142l1.132-1.598l-0.028-1.826l1.684,1.207l1.302-1.485l3.439-0.032&#10;&#9;&#9;l3.396,0.438l2.335,0.84l1.047,2.513l1.359,0.189l1.472-0.064l1.245-0.89l1.727-0.189l2.561,3.357l2.094,3.556l3.425,1.427&#10;&#9;&#9;l3.75-2.054l1.344-1.356l2.094-0.876l3.991-1.05l8.137-3.165l1.5-1.079l0.34,0.395l1.203,0.174l3.651-1.339l3.821,0.876&#10;&#9;&#9;l1.783-2.926v-1.2l-0.085-1.129l0.623-0.851l0.594-0.972l-0.708-1.852l-0.057-2.329l2.703-2.158l3.255-1.471l2.491-2.404&#10;&#9;&#9;l2.901-2.208l3.679-0.687l2.448-2.856l4.09,5.046l1.571,0.103l1.755,0.242l2.278,2.603l3.326,1.043l1.218,0.406l-4.185,6.632&#10;&#9;&#9;l-4.301,4.312l-7.945,5.646l-2.596,0.779l-3.477,1.867l-25.417,20.011l-5.081,2.757l-16.502,5.873h-0.011l-0.223-1.989&#10;&#9;&#9;l-0.011-0.118l-0.98-0.773l-0.022,0.006l-0.223,0.056l-0.824,0.224l-0.524,1.104l-0.268,2.32l-0.746,0.874l-1.203,0.325&#10;&#9;&#9;l-1.593,0.706l-2.975,1.799l-2.975,1.311L432.236,546l-6.909,2.376l-7.577,1.378l-3.454,1.333l-2.073,2.925l-3.711-0.728&#10;&#9;&#9;l-2.284,0.88l-1.292,0.504l-5.271,3.905l-5.271,3.899l-0.33,0.383l-2.099,2.44l-5.605-0.331l-0.011-0.006l-2.34,0.336l-1.827,0.695&#10;&#9;&#9;l-1.883,1.076l-3.332,2.498l-0.958,0.224L375.051,570l-2.273-0.879l-2.407-1.244l-1.382-0.42l-0.958-0.286l-7.923,0.941&#10;&#9;&#9;l-2.262-0.443l-1.148-1.137l-0.735-1.496l-0.579-0.874l-0.435-0.655l-2.318,1.35l-2.072,0.157L346.867,564.482z"
							class="st0" title="Southern Province" />
						<text transform="matrix(1 0 0 1 330 540)">Southern</text>

						<path
							d="M421.219,464.782l-2.25,3.412l-1.415,3.551l-2.505,3.013l-1.302,3.059l-1.344,5.972l-2.59,3.686l-2.066,3.913&#10;&#9;&#9;l0.41,2.268l0.863,2.172l0.113,8.516l1.528,2.948l1.939,2.588l2.618,1.413l2.491,1.755l1.316,2.517l1.076,3.207l2.519,2.812&#10;&#9;&#9;l1.274,3.506l-0.693,2.42l-2.873-0.95l-5.024-1.018l-1.599-1.854l-2.08-1.637l-2.618,0.253l-2.604,0.623l-2.632-0.406&#10;&#9;&#9;l-10.047-3.659l-7.826-1.499v-1.313l0.722-0.737l-1.755-1.306l0.113-1.292l-1.528-1.894l-3.283,0.552l-2.462-0.438l0.906-2.449&#10;&#9;&#9;l-1.981-3.652l-6.014,0.794l-2.335,0.018l-0.948,2.232l-2.689,0.623l-2.675,0.384l-1.175-1.702l-2.208,0.071l-4.26-2.1l-2.038-0.05&#10;&#9;&#9;l-2.307-0.94l-1.868-1.581l-1.67-1.73l-4.953-8.616l-5.788-8.151l-0.722-2.34l2.066-0.794l-1.981-3.793l-3.057-2.796l-1.91-0.741&#10;&#9;&#9;l-1.514-1.421l-0.807-4.018l-4.175-4.057l-1.33-2.757l-0.877-2.593l0.198-2.202l-2.392-6.327l-0.453-2.84l3.014-2.704l-3.368-3.581&#10;&#9;&#9;l0.708-1.636l0.58-1.921l1.486-2.359l1.755-2.149l-0.071-1.344l-0.184-1.333l1.826-1.711l-0.425-2.509l-2.363-1.205l-2.972-0.2&#10;&#9;&#9;l0.41-1.133l-0.028-1.258l-2.038-6.548l0.707-4.018l1.741-4.018l1.981-1.373l1.033-2.342l-2.887-0.845l-3.34,0.795l-1.67-3.458&#10;&#9;&#9;l0.58-3.908l2.165-1.123l1.783-1.68l0.368-4.743l1.344-1.07l-0.226-1.833l2.788-1.623l2.83-2.529l3-2.158l3.212-1.502l6.694-1.494&#10;&#9;&#9;l1.458-0.061l0.991-1.334l0.453-1.63l-0.156-2.832l0.481-2.618l3.014-1.206l3.269,0.446l1.995,2.069l1.26,2.661l1.684,4.234&#10;&#9;&#9;l5.915,5.197l-0.226,2.664l1.16,0.813l3.481,1.929l1.656,2.022l-0.325,2.461l0.028,2.022l1.981,1.975l1.599,2.008l-0.778,1.815&#10;&#9;&#9;l-1.076,1.697l-1.486,0.353l-1.5,0.086l-2.151,2.335l-4.741,0.777l-1.571,1.448l2.08,4.977l0.991,1.718l-0.991,2.121l-0.071,2.734&#10;&#9;&#9;l0.184,0.446l0.453,0.125l-1.203,1.946l-1.896,1.672l-1.047,0.356l-0.75,1.023l0.764,1.052l0.877,0.898l-0.962,5.121l1.189,3.992&#10;&#9;&#9;l3.977,1.29l3.17,2.359l1.047,3.62l0.227,1.846l-1.571,1.382l-0.099,2.259l0.934,1.019l-1.047,0.983l-0.495,1.414l2.816,2.152&#10;&#9;&#9;l3.34,0.271l7.104,1.603l7.514,1.022l2.887-0.481l3.396-0.271l4.543,0.15l4.274-0.581l7.755-4.058l0.368,5.07l1.019-0.502&#10;&#9;&#9;l1.005-0.395l1.868,2.059l2.363,0.73l-0.326,1.29l-0.439,1.069l-0.524,0.538l-3.708,1.692l-0.651,1.81l1.443,2.28l2.094,1.695&#10;&#9;&#9;l3.128,0.595l3.297-1.346l2.788-2.059L421.219,464.782z"
							class="st0" title="Sabaragamuwa Province" />
						<text transform="matrix(0.866 0.5 -0.5 0.866 326 445)">Sabaragamuwa</text>

						<path
							d="M420.101,518.773l-1.076-3.207l-1.316-2.517l-2.491-1.755l-2.618-1.413l-1.939-2.588l-1.528-2.948&#10;&#9;&#9;l-0.113-8.516l-0.863-2.172l-0.41-2.268l2.066-3.913l2.59-3.686l1.344-5.972l1.302-3.059l2.505-3.013l1.415-3.551l2.25-3.412&#10;&#9;&#9;l-2.505,0.132l-2.788,2.059l-3.297,1.346l-3.128-0.595l-2.094-1.695l-1.443-2.28l0.651-1.81l3.708-1.692l0.524-0.538l0.439-1.069&#10;&#9;&#9;l0.326-1.29l-2.363-0.73l-1.868-2.059l-1.005,0.395l-1.019,0.502l-0.368-5.07l2.59-0.645l1.401-1.988l-1.259-0.638l-1.259-0.809&#10;&#9;&#9;l2.009-3.278l-0.538-0.93l-0.693-0.844l-0.778-2.117l-0.906-1.924l-4.373-2.202l-0.156-2.199l2.477-0.121l2.561,0.146l1.84-2.12&#10;&#9;&#9;l0.665-2.734l2.165-1.989l2.477-1.183l5.179-1.126l3.043-4.527l0.623-2.691l1.259-2.438l1.104-1.012l0.892-1.141l0.453-1.02&#10;&#9;&#9;l-0.198-0.959l-0.75-2.446l0.665-1.276l0.934-1.155l-0.495-0.706l-0.623-0.742l-0.283-1.162l0.297-1.259l-1.033-3.441l0.113-2.485&#10;&#9;&#9;l1.741-1.059l2.929-0.827l3.693-3.438l0.241-4.476l-3-9.99l-1.203-20.846l-0.665-11.298l1.316-6.492l0.382,0.364l2.066,1.274&#10;&#9;&#9;l0.892,1.967l0.184,2.252l1.09,3.312l3.368,5.635l2.491-0.878l1.373-0.318l1.656-0.639l2.915-2.698l6.722-3.776l6.085,1.324&#10;&#9;&#9;l0.524,6.905l-1.443,6.712l-0.764,1.424l-0.382,1.242l0.41,1.702l0.552,1.72l0.892,6.075l1.514,3.232l2.052,2.03l1.189-0.289&#10;&#9;&#9;l1.684,0.321l0.566,1.227l0.948,1.602l1.231,2.49l0.481,2.475l1.076,2.671l1.203,2.243l2.774-0.966l2.547-1.865l-0.722-5.15&#10;&#9;&#9;l-0.014-5.3l3.396,0.153l2.774-1.541l0.637-0.97l0.948-1.149l0.623-1.359l-0.156-1.623l-0.75-1.627l-0.028-1.805l1.401-0.107&#10;&#9;&#9;l1.896-0.492l0.934-1.477l0.509-1.292l1.514-0.678l1.656-0.578l3.425-1.837l2.689,0.732l-2.024,3.147l0.863,0.525l0.906,0.16&#10;&#9;&#9;l-0.269,1.855l1.627,7.27l-0.198,3.296l0.552,2.661l3.028,2.636l1.91,3.345l0.396,2.967l2.972,4.123l-2.222,1.754l-2.859,3.391&#10;&#9;&#9;l-1.599,4.282l1.769,3.223l0.552,2.139l1.061,1.893l1.104,0.485h1.019l0.849,0.506l0.708,0.627l4.882,1.262l4.047,2.442&#10;&#9;&#9;l-0.269,2.592l-0.637,2.723l0.948,2.652l0.014,2.666l1.642,2.359l0.679,2.727l-3.566,50.589l-2.448,2.856l-3.679,0.687&#10;&#9;&#9;l-2.901,2.208l-2.491,2.404l-3.255,1.471l-2.703,2.158l0.057,2.329l0.708,1.852l-0.594,0.972l-0.623,0.851l0.085,1.129v1.2&#10;&#9;&#9;l-1.783,2.926l-3.821-0.876l-3.651,1.339l-1.203-0.174l-0.34-0.395l-1.5,1.079l-8.137,3.165l-3.991,1.05l-2.094,0.876l-1.344,1.356&#10;&#9;&#9;l-3.75,2.054l-3.425-1.427l-2.094-3.556l-2.561-3.357l-1.727,0.189l-1.245,0.89l-1.472,0.064l-1.359-0.189l-1.047-2.513&#10;&#9;&#9;l-2.335-0.84l-3.396-0.438l-3.439,0.032l-1.302,1.485l-1.684-1.207l0.028,1.826l-1.132,1.598l-1.854,0.142l-1.727-0.014&#10;&#9;&#9;l-0.665,3.126l1.316,3.086l-2.972,2.253l-3.863,1.26l-3.453,1.869L420.101,518.773z"
							class="st0" title="Uva Province" />
						<text transform="matrix(1 0 0 1 450 450)">Uva</text>

						<path
							d="M397.685,281.884l1.203,1.168l1.896,2.151l-0.042,2.429l0.75,0.814l1.146,0.425l0.877-0.564l0.057-0.879&#10;&#9;&#9;l1.656-0.789l1.585,0.457l2.165,0.443l2.009,1.207l-4.104,4.312l-1.344,6.547l-0.382,3.157l-1.316,5.585l-0.467,0.989l-0.255,1&#10;&#9;&#9;l-3.977,0.889l-0.92,3.796l1.854,8.398l-0.255,2.695l1.358,1.931l3.609,0.792l3.439-1.439l2.731-2.492l1.175,1.642l2.094,1.314&#10;&#9;&#9;l0.594-2.42l0.311-2.474l7.345,0.503l7.09-1.292l-0.099,2.31l0.991,3.113l0.297,2.66l-1.316,6.539l-1.316,6.492l0.665,11.298&#10;&#9;&#9;l1.203,20.846l3,9.99l-0.241,4.476l-3.693,3.438l-2.929,0.827l-1.741,1.059l-0.113,2.485l1.033,3.441l-0.297,1.259l0.283,1.162&#10;&#9;&#9;l0.623,0.742l0.495,0.706l-0.934,1.155l-0.665,1.276l0.75,2.446l0.198,0.959l-0.453,1.02l-0.892,1.141l-1.104,1.012l-1.259,2.438&#10;&#9;&#9;l-0.623,2.691l-3.043,4.527l-5.179,1.126l-2.477,1.183l-2.165,1.989l-0.665,2.734l-1.84,2.12l-2.561-0.146l-2.477,0.121&#10;&#9;&#9;l0.156,2.199l4.373,2.202l0.906,1.924l0.778,2.117l0.693,0.844l0.538,0.93l-2.009,3.278l1.259,0.809l1.259,0.638l-1.401,1.988&#10;&#9;&#9;l-2.59,0.645l-7.755,4.058l-4.274,0.581l-4.543-0.15l-3.396,0.271l-2.887,0.481l-7.514-1.022l-7.104-1.603l-3.34-0.271&#10;&#9;&#9;l-2.816-2.152l0.495-1.414l1.047-0.983l-0.934-1.019l0.099-2.259l1.571-1.382l-0.227-1.846l-1.047-3.62l-3.17-2.359l-3.977-1.29&#10;&#9;&#9;l-1.189-3.992l0.962-5.121l-0.877-0.898l-0.764-1.052l0.75-1.023l1.047-0.356l1.896-1.672l1.203-1.946l-0.453-0.125l-0.184-0.446&#10;&#9;&#9;l0.071-2.734l0.991-2.121l-0.991-1.718l-2.08-4.977l1.571-1.448l4.741-0.777l2.151-2.335l1.5-0.086l1.486-0.353l1.076-1.697&#10;&#9;&#9;l0.778-1.815l-1.599-2.008l-1.981-1.975l-0.028-2.022l0.325-2.461l-1.656-2.022l-3.481-1.929l-1.16-0.813l0.226-2.664l-5.915-5.197&#10;&#9;&#9;l-1.684-4.234l2.83,0.31l2.462-0.724l-0.226-0.642l-0.113-0.902l0.467-0.81l0.58-0.753l0.439-2.761l1.967-0.004l2.123,1.52&#10;&#9;&#9;l2.349,0.178l0.198-1.434l-0.212-1.541l2.009-1.12l1.967,0.342l1.472-0.706l-0.821-1.877l-1.104-1.752l1.613-0.417l1.642-0.76&#10;&#9;&#9;l0.071-1.427l0.764-1.042l0.283-1.67l-0.382-1.727l-0.693-1.456l-0.835-1.381l-1.373-2.769l0.34-2.916l1.939-1.774l0.495-1.185&#10;&#9;&#9;l-0.028-1.256l0.396-1.631l0.057-1.62l-2.505-2.456l-0.764-4.276l-0.396-4.616l-0.694-0.993l-0.495-0.346l-0.042-2.381&#10;&#9;&#9;l-0.934-2.371l-1.359-2.285l-0.977-2.149l-1.033-0.289l-1.217-0.686l-0.354-2.421l0.637-2.257l2.915-2.16l4.599-1.703l2.42-2.936&#10;&#9;&#9;l2.208,0.086l1.642,1.089l2.038-1.418l1.019-1.668l0.948-0.664l0.892-0.525l-0.085-0.979l-0.311-0.643l1.755-1.814l1.316-2.004&#10;&#9;&#9;l-0.028-2.572l0.764-2.208h1.373l1.033,0.257l0.793-0.557l2.66-2.801l1.783-1.572l2.604-1.315L397.685,281.884z"
							class="st0" title="Central Province" />
						<text transform="matrix(1 0 0 1 375 380)">Central</text>

						<path
							d="M429.568,322.18l-7.09,1.292l-7.345-0.503l-0.311,2.474l-0.594,2.42l-2.094-1.314l-1.175-1.642l-2.731,2.492&#10;&#9;&#9;l-3.439,1.439l-3.609-0.792l-1.358-1.931l0.255-2.695l-1.854-8.398l0.92-3.796l3.977-0.889l0.255-1l0.467-0.989l1.316-5.585&#10;&#9;&#9;l0.382-3.157l1.344-6.547l4.104-4.312l-2.009-1.207l-2.165-0.443l-1.585-0.457l-1.656,0.789l-0.057,0.879l-0.877,0.564&#10;&#9;&#9;l-1.146-0.425l-0.75-0.814l0.042-2.429l-1.896-2.151l-1.203-1.168l-2.859,1.168l-2.604,1.315l-1.783,1.572l-2.66,2.801&#10;&#9;&#9;l-0.793,0.557l-1.033-0.257h-1.373l-0.764,2.208l0.028,2.572l-1.316,2.004l-1.755,1.814l0.311,0.643l0.085,0.979l-0.892,0.525&#10;&#9;&#9;l-0.948,0.664l-1.019,1.668l-2.038,1.418l-1.642-1.089l-2.208-0.086l-2.42,2.936l-4.599,1.703l-2.915,2.16l-3.481-3.35l0.524-4.8&#10;&#9;&#9;l-0.679-3.268l-1.288-3.204l-0.354-2.315l-1.132-1.904l-2.208-0.161l-1.91-0.804l-0.255-2.404l0.184-2.515l-0.396-2.951&#10;&#9;&#9;l0.241-1.743l-0.043-1.729l-2.066-1.701l-2.576,0.086l-2.477-1.536l-2.236-2.258l-4.118-3.352l-4.543-1.755l-2.533-0.375&#10;&#9;&#9;l-2.052-1.479l-2.618-1.054l-2.703-0.679l-12.623-5.808l-2.958-1.648l-1.528-1.98l-2.024-1.623l-2.774,0.1l-2.448-1.841&#10;&#9;&#9;l-2.307,1.051l-2.844,0.014l-0.849-2.456l-3.41-13.951l-2.01-3.88l1.5-3.429l2.307-1.066l0.623-1.241l0.184-0.973l4.274-3.505&#10;&#9;&#9;l2.491-5.297l-0.778-5.716l1.132,0.562l1.316,0.154l0.283-12.833l-1.09-8.116l6.099,2.491l6.722,0.021l13.316-3.504l0.057,4.498&#10;&#9;&#9;l1.401,3.9l2.08,0.716l2.024,0.927l0.877,1.707l0.509,1.878l1.458,2.934l2.887,1.546l1.429,0.401l1.33,0.079l2.094-3.789&#10;&#9;&#9;l2.434-1.063l2.547-5.968l5.392-7.025l4.175-1.922l2.533,1.349l2.321,1.661l4.359-0.032l3.651-2.795l3.467-3.128l2.986-3.501&#10;&#9;&#9;l1.656-2.549l1.925-2.359l3.255-2.585l-1.146-3.587l-2.519-3.265l-3.566-1.239l-0.255-3.04l10.189-0.354l3.977-2.789l3.594-1.028&#10;&#9;&#9;l3.764-0.716l3.863-1.586l4.019,0.089l3.495,1.984l5.958,4.175l2.108,2.32l1.104,1.49l1.302,0.992l-1.599,3.594l-2.321,3.433&#10;&#9;&#9;l0.085,5.953l2.533,5.569l1.047,2.888l-2.123,4.974l0.113,2.827l1.16,1.324l1.458,1.424l0.566,3.303l3.623,5.406l1.925,4.597&#10;&#9;&#9;l1.231,1.563l1.585,1.227l0.92,2.128l-1.132,2.042l-1.953,1.266l-1.684,1.667l-0.566,1.67l-0.311,1.742l-2.972,10.631l2.052-0.601&#10;&#9;&#9;l1.599,2.374l2.222,0.858l2.094,1.652l0.566,2.882l1.712,1.723l5.774-0.568l10.373,2.542l2.448,0.004l2.278,1.294l2.208,1.705&#10;&#9;&#9;l2.42,1.244l1.726-0.132l0.977,1.383l0.212,1.759l-0.057,1.784l0.481,2.627l-0.736,1.723l-1.585,1.001l0.538,0.386l0.665,0.225&#10;&#9;&#9;l3.439-0.783l1.939-4.543l0.694-1.323l0.863-3.617l0.948-0.826l1.033-0.776l0.906-1.652l1.245-1.344l1.712,0.004l2.123-0.014&#10;&#9;&#9;l0.722,7.214l-1.104,21.811l1.005,5.091l2.292,4.994l1.132,5.151l-1.259,0.096l-4.967-0.657l-3.92,0.546l-3.071,2.075l-1.033,4.015&#10;&#9;&#9;l-1.203,10.639l1.939,10.691l-0.623,3.11l0.424,3.263l-0.75,1.482l-0.877,0.921l-0.637,1.617l-0.326,1.424l-2.675-0.321&#10;&#9;&#9;l-3.227-1.849l-6.623-2.06l-4.047-4.073l-4.981-1.921l-2.505,0.443l-5.109,0.493L429.568,322.18z"
							class="st0" title="North Central Province" />
						<text transform="matrix(1 0 0 1 330 250)">North Central</text>
					</g>
				</svg>
			</div>
		</div>

		<div id="other-selection">

			<div id="search-heading-and-form">
				<h1 class="heading">Find Clinic Details</h1>

				<form id="search-form" method="post">

					<div class="form-field">
						<label for="district-dropdown">District</label>
						<select type="text" name="district" id="district-dropdown" disabled>
							<option value="" selected hidden>Select Your District</option>
						</select>
					</div>

					<div class="form-field">
						<label for="hospital-category-dropdown">Hospital Category</label>
						<select type="text" name="hospital_category" id="hospital-category-dropdown" disabled>
							<option value="" selected hidden>Select Hospital Category</option>
						</select>
					</div>

					<div class="form-field">
						<label for="hospital-dropdown">Hospital</label>
						<select type="text" name="hospital" id="hospital-dropdown" disabled>
							<option value="" selected hidden>Select Hospital</option>
						</select>
					</div>

					<div class="form-field">
						<label for="clinic-category-dropdown">Clinic</label>
						<select type="text" name="clinic_category" id="clinic-category-dropdown" disabled>
							<option value="" selected hidden>Select Clinic Category</option>
						</select>
					</div>

					<div class="form-field">
						<div id="button-wrapper">
							<button type="reset" id="btn-clear" disabled>Clear</button>
							<button type="button" id="btn-search" disabled>Search</button>
						</div>

					</div>


				</form>
			</div>

		</div>


	</section>

	<section id="selected-clinic-info">
		<div id="selected-clinic-info-container">
			<div id="selected-clinic-info-title">
				<h1>Clinic Details</h1>
			</div>
			<div id="selected-clinic-info-content">
				<div id="not-selected-msg">
					<h1>No clinic selected yet.</h1>
				</div>
				<div id="selection-criteria">
					<h1 id="province">Province: </h1>
					<h1 id="district">District: </h1>
					<h1 id="hospital">Hospital: </h1>
					<h1 id="clinic-category">Clinic: </h1>
				</div>
				<div id="table-container">
					<table id="clinicTable">
						<thead>
							<tr>
								<th>Clinic Place</th>
								<th>Clinic Day</th>
								<th>Clinic Time</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
				</div>

			</div>
		</div>


	</section>


</body>

</html>