var express = require('express');
var router = express.Router();
var config = require('../config/database');
const fileUpload = require('express-fileupload')
router.use(fileUpload());


const News = require('../models/news.js');

router.get('/', function (req, res) {
	

	var sql = "SELECT  news.id, news.news_title, news_categories.title, media_table.media_data,media_table.media_name, authorize_users.username FROM (((news JOIN news_categories ON news.news_categories_id =news_categories.id)LEFT JOIN media_table ON news.id=media_table.news_id) JOIN authorize_users ON news.authorize_users_id=authorize_users.id)ORDER BY id DESC";
	config.query(sql, function (err, result) {
		if (err) throw err;
		res.render('admin/news', {
			news: result,
			Title: 'AdminArea All News',
		});
	});

});



router.get('/add_news', function (req, res) {
	var sql = "SELECT * FROM news_categories";
	config.query(sql, function (err, result) {
		if (err) throw err;

		res.render('admin/add_news', {
			headline: '',
			subheadline: '',
			description: '',
			categories: result,
			authorize_users_id: '',
			media: '',
			Title: 'AdminArea All News',
		});
	});
});

router.post('/upload', function (req, res) {
	req.checkBody('headline', 'headline Must have a value.').notEmpty();
	req.checkBody('subheadline', 'Subheadline Must have a value.').notEmpty();

	req.checkBody('categories', 'categories Must have a value.').notEmpty();
	req.checkBody('authorize_users_id', 'autherize_user Must have a value.').notEmpty();

	req.checkBody('description', 'description Must have a value.').notEmpty();
	var headline = req.body.headline;
	var subheadline = req.body.subheadline;
	var categories = req.body.categories;
	var authorize_users_id = req.body.authorize_users_id;
	var description = req.body.description;

	if (req.files == null) {
		req.checkBody('files', 'files must uploaded need.').notEmpty();
		var errors = req.validationErrors();
		if (errors) {
			console.log("error file is not uploaded");
			var sql = "SELECT * FROM news_categories";
			config.query(sql, function (err, result) {
				if (err) throw err;
				res.render('admin/add_news', {
					errors: errors,
					headline: headline,
					subheadline: subheadline,
					categories: result,
					authorize_users_id: authorize_users_id,
					description: description,
					Title: 'AdminArea Add News',
				});
			});
		}
	} else {

		var images = req.files.myFiles;
		for (var i = 0; i < images.length; i++) {
			req.checkBody('files', 'files must uploaded anImage.').isImage(images[i].mimetype);
		}
		var errors = req.validationErrors();
		if (errors) {
			console.log("error another extensions");
			var sql = "SELECT * FROM news_categories";
			config.query(sql, function (err, result) {
				if (err) throw err;
				res.render('admin/add_news', {
					errors: errors,
					headline: headline,
					subheadline: subheadline,
					categories: result,
					authorize_users_id: authorize_users_id,
					description: description,
					Title: 'AdminArea Add News',
				});
			});
		} else {
			News.insert(headline, subheadline, description, categories, authorize_users_id);
			saveMediaFiles(description, req.files.myFiles);

			req.flash('success', 'Successfuly News  Added!');
			res.redirect('/admin_news');
		}
	}

});
function saveMediaFiles(des, Files) {

	var a = des;
	var b = Files;
	if (Files.length != undefined) {

		for (var i = 0; i < b.length; i++) {
			// read binary data
			var bitmap = b[i].data;
			//	console.log(bitmap);
			//encode in base64
			var base64str = base64_encode(bitmap);
			News.media_insert(a, b[i].name, b[i].mimetype, b[i].size, base64str);
		}
	} else {
		// read binary data
		var bitmap = b.data;
		//	console.log(bitmap);
		//encode in base64
		var base64str = base64_encode(bitmap);
		News.media_insert(a, b.name, b.mimetype, b.size, base64str);
	}

}


// function to encode file data to base64 encoded string
function base64_encode(file) {
	// convert binary data to base64 encoded string
	return new Buffer.from(file).toString('base64');
}

router.get('/edit_news/:id', function (req, res) {
	var ids = req.params.id;
	var sql_select = "SELECT  n.id, n.news_title, n.sub_title,n.description, c.title, m.media_data,m.media_name,m.media_id,u.username  FROM (((news AS n JOIN news_categories AS c ON n.news_categories_id =c.id)LEFT JOIN media_table AS m ON n.id=m.news_id) JOIN authorize_users AS u ON n.authorize_users_id=u.id) WHERE n.id='" + ids + "'";
	//var sql_select = "SELECT * FROM news	WHERE id='" + ids + "'";
	config.query(sql_select, function (err, resulted_data) {
		if (err) throw err;
		var sql_categories = "SELECT * FROM news_categories";
		config.query(sql_categories, function (err, resulted_cat) {
			if (err) throw err;
			console.log(resulted_data);
			if (resulted_data[0].media_data == null) {
				console.log(resulted_data[0].title);
				res.render('admin/edit_news', {
					id: resulted_data[0].id,
					title: resulted_data[0].news_title,
					subtitle: resulted_data[0].sub_title,
					description: resulted_data[0].description,
					categories: resulted_data[0].title,
					all_categories: resulted_cat,
					authorize_users_id: resulted_data[0].username,
					icon: '',
					Title: 'AdminArea Edit News',
				});
			} else {
				res.render('admin/edit_news', {
					id: resulted_data[0].id,
					title: resulted_data[0].news_title,
					subtitle: resulted_data[0].sub_title,
					description: resulted_data[0].description,
					categories: resulted_data[0].title,
					all_categories: resulted_cat,
					authorize_users_id: resulted_data[0].username,
					icon: resulted_data,
					Title: 'AdminArea Edit News',

				});
			}
		});
	});
});

router.get('/delete_news/:id', function (req, res) {
	var ids = req.params.id;
	var sql_delete = "DELETE news.*,media_table.* FROM media_table LEFT JOIN news ON media_table.news_id= news.id WHERE media_table.news_id='" + ids + "'";
	config.query(sql_delete, function (err, result) {
		if (err) throw err;
		if (result.affectedRows == 0) {
			var sql_delete = "DELETE news.* FROM news WHERE news.id='" + ids + "'";
			config.query(sql_delete, function (err, result) {
				if (err) throw err;
			});
		}
		console.log("record deleted");
	});

	req.flash('success', 'Successfuly News Deleted');
	res.redirect('/admin_news');

});

router.get('/delete_single_icon/:media_id/:id', function (req, res) {

	var media_id = req.params.media_id;
	var news_id = req.params.id;

	var sql_delete_icon = "DELETE FROM media_table WHERE media_id='" + media_id + "'";
		config.query(sql_delete_icon, function (err,resulted) {
			if (err) throw err;
			//console.log(resulted);
		});
	console.log(news_id);
	var sql_select = "SELECT  news.id, news.news_title, news.sub_title,news.description, news_categories.title, media_table.media_data,media_table.media_name,media_table.media_id,authorize_users.username  FROM (((news JOIN news_categories ON news.news_categories_id =news_categories.id)LEFT JOIN media_table ON news.id=media_table.news_id) JOIN authorize_users ON news.authorize_users_id=authorize_users.id) WHERE news.id='" + news_id + "'";

	config.query(sql_select, function (err, resulted_data) {
		if (err) throw err;
		var sql_categories = "SELECT * FROM news_categories";
		config.query(sql_categories, function (err, resulted_cat) {
			if (err) throw err;
			console.log(resulted_data);
			if (resulted_data[0].media_data == null) {
				console.log(resulted_data[0].title);
				res.render('admin/edit_news', {
					id: resulted_data[0].id,
					title: resulted_data[0].news_title,
					subtitle: resulted_data[0].sub_title,
					description: resulted_data[0].description,
					categories: resulted_data[0].title,
					all_categories: resulted_cat,
					authorize_users_id: resulted_data[0].username,
					icon: '',
					Title: 'AdminArea Edit News',
				});
			} else {
				res.render('admin/edit_news', {
					id: resulted_data[0].id,
					title: resulted_data[0].news_title,
					subtitle: resulted_data[0].sub_title,
					description: resulted_data[0].description,
					categories: resulted_data[0].title,
					all_categories: resulted_cat,
					authorize_users_id: resulted_data[0].username,
					icon: resulted_data,
					Title: 'AdminArea Edit News',

				});
			}
		});
	});

});
router.post('/update/:id', function (req, res) {
	var ids = req.params.id;
	console.log("This is Firdous!");
	req.checkBody('headline', 'headline Must have a value.').notEmpty();
	req.checkBody('subheadline', 'Subheadline Must have a value.').notEmpty();

	req.checkBody('categories', 'categories Must have a value.').notEmpty();
	req.checkBody('authorize_users_id', 'autherize_user Must have a value.').notEmpty();

	req.checkBody('description', 'description Must have a value.').notEmpty();
	var headline = req.body.headline;
	var subheadline = req.body.subheadline;
	var categories = req.body.categories;
	var authorize_users_id = req.body.authorize_users_id;
	var description = req.body.description;

	if (req.files == null) {
		//req.checkBody('files', 'files must uploaded need.').notEmpty();
		var errors = req.validationErrors();
		if (errors) {
			console.log("error file is not uploaded");
			var sql = "SELECT * FROM news_categories";
			config.query(sql, function (err, result) {
				if (err) throw err;
				res.render('admin/add_news', {
					errors: errors,
					headline: headline,
					subheadline: subheadline,
					categories: result,
					authorize_users_id: authorize_users_id,
					description: description,
					Title: 'AdminArea Add News',
				});
			});
		}else{
			console.log(ids);
			News.update_query(ids,headline, subheadline, description, categories, authorize_users_id);	
		}
		res.redirect('/admin_news');
	} else {

		var images = req.files.myFiles;
		for (var i = 0; i < images.length; i++) {
			req.checkBody('files', 'files must uploaded anImage.').isImage(images[i].mimetype);
		}
		var errors = req.validationErrors();
		if (errors) {
			console.log("error another extensions");
			var sql = "SELECT * FROM news_categories";
			config.query(sql, function (err, result) {
				if (err) throw err;
				res.render('admin/add_news', {
					errors: errors,
					headline: headline,
					subheadline: subheadline,
					categories: result,
					authorize_users_id: authorize_users_id,
					description: description,
					Title: 'AdminArea Add News',
				});
			});
		} else {
			News.update_query(ids,headline, subheadline, description, categories, authorize_users_id);
			saveMediaFiles(description, req.files.myFiles);

			req.flash('success', 'Successfuly News  Edited!');
			res.redirect('/admin_news');
		}
	}

});
//Exports
module.exports = router;