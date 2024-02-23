<?php
require_once '../models/registerModel.php';

$model = new Register($_POST);

$model->getInfo();