var express = require('express');
var router = express.Router();
var config = require('../config/database');
const fileUpload = require('express-fileupload')
router.use(fileUpload());

const News = require('../models/news_categories');
var sql = "SELECT title FROM news_categories";
config.query(sql, function (err, result) {
	if (err) throw err;
	var sel = "SELECT news_title FROM news";
	config.query(sel, function (err, newsTitle) {
		if (err) throw err;

	router.get('/', function (req, res) {
		res.render('frentEnd/index', {
			title:"Live Caster",
			obj: result,
			news:newsTitle
		});
		});
	});
});	
router.get('/login', function (req, res) {
	res.render('frentEnd/index', {
		title:"Live Caster",
		obj: result,
		news:newsTitle
	});
	});

	//Exports
	module.exports = router;