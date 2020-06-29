package com.example.messagereportermodule;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;


public class messageReceive extends AppCompatActivity implements MessageListener, MyJson {

    public static String urlString;
    public static String postingHeadline;
    public static String validation_status="no";
    public static String authorise_users_id;

    WebView myWebView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_message_receive);

        myWebView = (WebView) findViewById(R.id.webview);

        WebViewClient MyWebViewClient = new WebViewClient();
        myWebView.setWebViewClient(MyWebViewClient);

        //Register sms listener
        MyReceiver.bindListener(this);
    }
    @Override
    public void messageReceived(String message, String msg_form) {

        //TextView txt = findViewById(R.id.textView);
        //txt.setText(message);

        postingHeadline = message;
        urlString = "checkUser="+msg_form;
        AsyncRetrieve a = new AsyncRetrieve(urlString,messageReceive.this);
        a.execute();



        //url = new URL("http://10.0.2.2/androidapi.php?username=ehtsham&password=ehtsham&login");
       /* String myURL = "https://livecaster.000webhostapp.com/post_headline.php?headline=";
        myURL+= message;
        myURL +=msg_form;

        myWebView.loadUrl(myURL);*/

    }



    @Override
    public void myJson(String result) {

        try {
            JSONObject obj = new JSONObject(result);
            JSONArray arr = obj.getJSONArray("output");
            for (int i = 0; i < arr.length(); i++) {


                    validation_status = arr.getJSONObject(i).getString("validation_status");
                    authorise_users_id = arr.getJSONObject(i).getString("authorize_users_id");

                    if (validation_status.equals("yes")) {
                        Toast.makeText(getApplicationContext(), "Posting.....", Toast.LENGTH_LONG).show();
                        String myURL = "http://10.0.2.2/androidapi.php?postingHeadline="+postingHeadline+"&authorize_users_id="+authorise_users_id;
                        myWebView.loadUrl(myURL);


                    } else if (validation_status.equals("no")) {
                        Toast.makeText(getApplicationContext(), "You are not Vaild. Your Validation Status is: " + validation_status, Toast.LENGTH_LONG).show();
                    }
                    //Toast.makeText(getApplicationContext(),validation_status,Toast.LENGTH_LONG).show();
                }


        } catch (final JSONException e) {
            Log.e(null, "Json parsing error: " + e.getMessage());
            runOnUiThread(new Runnable() {
                @Override
                public void run() {
                    Toast.makeText(getApplicationContext(),
                            "Json parsing error: " + e.getMessage(),
                            Toast.LENGTH_LONG).show();
                }
            });

        }
        // Toast.makeText(MainActivity.this, result, Toast.LENGTH_LONG).show();
    }


}
