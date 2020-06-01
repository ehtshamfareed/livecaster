var express = require('express');
var router = express.Router();
var config = require('../config/database');
const passport = require('passport');
const fileUpload = require('express-fileupload')
router.use(fileUpload());

const News = require('../models/news_categories');

router.get('/login', function (req, res) {
    res.render('admin/login', {
        title: 'User Login ',
        username: '',
        password: '',
    });
});

router.post('/login',function(req,res,next){
passport.authenticate('local', { successRedirect: '/admin_news',
failureRedirect: '/users/login',
failureFlash: true })(req,res,next);
});



router.get('/register', function (req, res) {

    res.render('admin/register', {
        username: '',
        email: '',
        password: '',
        phone_number: '',
        user_category: '',
        address: '',
        p_picture: '',
        v_code: '',
        v_status: '',
        r_date: '',
        title: 'Register User',
    });
});

router.post('/register', function (req, res) {
    var username = req.body.username;
    var email = req.body.email;
    var password  = req.body.password;
    var phone_number = req.body.phone_number;
    var user_category = req.body.user_category;
    var address = req.body.address;
    var p_picture = req.files.p_picture.data;
    var v_code = req.body.v_code;
    var v_status = req.body.v_status;
    var r_date = req.body.r_date;

    req.checkBody('title', 'Title Must have a value.').notEmpty();
    req.checkBody('description', 'Description Must have a value.').notEmpty();
    var title = req.body.title;
    var description = req.body.description;
    if (!req.files || Object.keys(req.files).length === 0) {
        req.checkBody('files', 'icon file must uploaded need.').notEmpty();
        var errors = req.validationErrors();
        if (errors) {
            console.log("error file is not uploaded");
            res.render('admin/add_categories', {
                errors: errors,
                title: title,
                description: description,
                Title: 'AdminArea Add News Categories',
            });

        }
    } else {
        var image = req.files.icon;
        req.checkBody('files', 'icon file must uploaded anImage.').isImage(image.mimetype);
        var errors = req.validationErrors();
        if (errors) {
            console.log("error another extensions");
            res.render('admin/add_categories', {
                errors: errors,
                title: title,
                description: description,
                Title: 'AdminArea Add News Categories',
            });
        } else {
            var Query = "SELECT title from news_categories WHERE title='" + title + "'";
            config.query(Query, function (err, rows, fields) {
                if (err) { console.log(err); }
                if (rows.length == 0) {//NOT matched rows
                    // read binary data
                    var bitmap = image.data;

                    // function to encode file data to base64 encoded string
                    function base64_encode(file) {
                        // convert binary data to base64 encoded string
                        return new Buffer.from(file).toString('base64');
                    }
                    var base64str = base64_encode(bitmap);
                    News.insert(title, description, base64str);
                    req.flash('success', 'News Categories Added!');
                    res.redirect('/admin_categories');
                } else {// matched rows
                    req.flash('dengar', 'This ' + title + ' is Exist choose another title');
                    res.render('admin/add_categories', {
                        errors: errors,
                        title: '',
                        description: description,
                        Title: 'AdminArea Add News Categories',
                    });
                }
            });
        }
    }

});


router.get('/edit_categories/:id', function (req, res) {
    var ids = req.params.id;

    var sql_select = "SELECT * FROM news_categories	WHERE id='" + ids + "'";
    config.query(sql_select, function (err, resulted_data) {
        if (err) throw err;
        if (resulted_data[0].icon.toString() == "") {
            res.render('admin/edit_categories', {
                id: resulted_data[0].id,
                title: resulted_data[0].title,
                description: resulted_data[0].description,
                icon: '',
                Title: 'AdminArea Add News',
            });
        } else {
            res.render('admin/edit_categories', {
                id: resulted_data[0].id,
                title: resulted_data[0].title,
                description: resulted_data[0].description,
                icon: 'data:image/jpeg/png;base64,' + resulted_data[0].icon,
                Title: 'AdminArea Add News',
            });
        }

    });
});

router.get('/delete_categories/:id', function (req, res) {
    var ids = req.params.id;
    var sql_delete = "DELETE  FROM news_categories  WHERE id='" + ids + "'";
    config.query(sql_delete, function (err) {
        if (err) throw err;
        console.log("record deleted");
    });

    var sql_select = "SELECT * FROM news_categories";
    config.query(sql_select, function (err, all_data) {
        if (err) throw err;
        res.render('admin/categories', {
            object: all_data,
            Title: 'NewsArea All Categories',
            errorsType: '',
            msg: 'record Deleted Seccussfully'
        });
    });

});

router.get('/delete_categories/icon/:id', function (req, res) {

    var ids = req.params.id;
    var sql_delete_icon = "UPDATE  news_categories SET icon =''   WHERE id='" + ids + "'";
    config.query(sql_delete_icon, function (err) {
        if (err) throw err;
    });

    var sql_select = "SELECT * FROM news_categories	WHERE id='" + ids + "'";
    config.query(sql_select, function (err, resulted_data, fields) {
        if (err) throw err;
        res.render('admin/edit_categories', {
            id: resulted_data[0].id,
            title: resulted_data[0].title,
            description: resulted_data[0].description,
            icon: resulted_data[0].icon,
            Title: 'AdminArea Add News',
        });
    });

});
router.post('/update/:id', function (req, res) {
    var ids = req.params.id;
    req.checkBody('title', 'Title Must have a value.').notEmpty();
    req.checkBody('description', 'Description Must have a value.').notEmpty();
    var title = req.body.title;
    var description = req.body.description;
    if (!req.files || Object.keys(req.files).length === 0) {

        var Query = "SELECT icon from news_categories WHERE id='" + ids + "'";
        config.query(Query, function (err, rows, fields) {
            if (err) { console.log(err); }
            if (rows[0].icon.toString() == "") {//icon file is not exist
                req.checkBody('files', 'icon file must uploaded need.').notEmpty();
                var errors = req.validationErrors();
                if (errors) {
                    console.log("error file is not uploaded");
                    res.render('admin/edit_categories', {
                        id: ids,
                        errors: errors,
                        title: title,
                        description: description,
                        icon: '',
                        Title: 'AdminArea Add News Categories',
                    });
                }
            } else {//file is exist
                var errors = req.validationErrors();
                if (errors) {
                    console.log("error validation title or description!");
                    res.render('admin/edit_categories', {
                        id: ids,
                        errors: errors,
                        title: title,
                        description: description,
                        icon: 'data:image/jpeg/png;base64,' + rows[0].icon,
                        Title: 'AdminArea Add News Categories',
                    });
                } else {
                    var file = rows[0].icon.toString();
                    News.update_query(ids, title, description, file);
                    req.flash('success', 'Recode Updated!');
                    res.redirect('/admin_categories');
                }
            }
        });



    } else {
        var image = req.files.icon;
        req.checkBody('files', 'icon file must uploaded an Image.').isImage(image.mimetype);
        var errors = req.validationErrors();
        if (errors) {
            console.log("error another extensions");
            res.render('admin/edit_categories', {
                id: ids,
                errors: errors,
                title: title,
                description: description,
                icon: '',
                Title: 'AdminArea Add News Categories',
            });
        } else {
            // read binary data
            var bitmap = image.data;

            // function to encode file data to base64 encoded string
            function base64_encode(file) {
                // convert binary data to base64 encoded string
                return new Buffer.from(file).toString('base64');
            }

            var base64str = base64_encode(bitmap);
            News.update_query(ids, title, description, base64str);
            req.flash('success', 'Recode Updated!');
            res.redirect('/admin_categories');

        }
    }

});
//Exports
module.exports = router;