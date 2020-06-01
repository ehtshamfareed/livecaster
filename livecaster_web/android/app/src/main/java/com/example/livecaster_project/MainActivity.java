package com.example.livecaster_project;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class MainActivity extends AppCompatActivity implements MyJson{

    public static String urlString;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        //Intent home_page_intent = new Intent(MainActivity.this,Home.class);
       // startActivity(home_page_intent);
    }

    public void login(View view){
         EditText txtUsername  = findViewById(R.id.inputUsername);
         EditText txtPassword  = findViewById(R.id.inputPassword);
        String username = txtUsername.getText().toString();
        String password = txtPassword.getText().toString();



         urlString = "username="+username+"&password="+password+"&login";

         AsyncRetrieve a = new AsyncRetrieve(urlString,MainActivity.this);
        a.execute();

        //url = new URL("http://10.0.2.2/androidapi.php?username=ehtsham&password=ehtsham&login");
    }
    @Override
    public void myJson(String result) {

        try {
            JSONObject obj = new JSONObject(result);
            JSONArray arr = obj.getJSONArray("output");
            for (int i = 0; i < arr.length(); i++)
            {
                String validation_status = arr.getJSONObject(i).getString("validation_status");

                if(validation_status.equals("yes")){
                Intent home_page_intent = new Intent(MainActivity.this,Home.class);
                startActivity(home_page_intent);
                }else{Toast.makeText(getApplicationContext(),"You are not Vaild for Login. Your Validation Status is: "+validation_status,Toast.LENGTH_LONG).show();}
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
