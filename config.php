<?php

	session_start();

	$con = mysqli_connect("127.0.0.1", "root", "", "fingerprinting");

	if (!$con) {
	  die("Connection failed: " . mysqli_connect_error());
	}