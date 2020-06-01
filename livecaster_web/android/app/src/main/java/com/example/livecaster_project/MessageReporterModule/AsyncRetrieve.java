package com.example.livecaster_project.MessageReporterModule;

import android.os.AsyncTask;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;

public class AsyncRetrieve extends AsyncTask<String, String, String> {

    MyJson myinterface;
    public static final int CONNECTION_TIMEOUT = 10000;
    public static final int READ_TIMEOUT = 15000;
    public String urlString;

    public AsyncRetrieve(String urlString,MyJson myinterface){
        this.urlString = urlString;
        this.myinterface = myinterface;
    }

    //ProgressDialog pdLoading = new ProgressDialog(MainActivity.this);
    HttpURLConnection conn;
    URL url = null;
    //this method will interact with UI, here display loading message
    @Override
    protected void onPreExecute() {
        super.onPreExecute();
    }

    // This method does not interact with UI, You need to pass result to onPostExecute to display
    @Override
    protected String doInBackground(String... params) {

        try {
            // Enter URL address where your php file resides
		//url = new URL("http://10.0.2.2/androidapi.php?username=ehtsham&password=ehtsham&login");
            url = new URL("http://10.0.2.2/androidapi.php?"+urlString);

        } catch (MalformedURLException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
            return e.toString();
        }
        try {

            // Setup HttpURLConnection class to send and receive data from php
            conn = (HttpURLConnection) url.openConnection();
            conn.setReadTimeout(READ_TIMEOUT);
            conn.setConnectTimeout(CONNECTION_TIMEOUT);
            conn.setRequestMethod("GET");

            // setDoOutput to true as we recieve data from json file
            conn.setDoOutput(true);

        } catch (IOException e1) {
            // TODO Auto-generated catch block
            e1.printStackTrace();
            return e1.toString();
        }

        try {

            int response_code = conn.getResponseCode();

            // Check if successful connection made
            if (response_code == HttpURLConnection.HTTP_OK) {

                // Read data sent from server
                InputStream input = conn.getInputStream();
                BufferedReader reader = new BufferedReader(new InputStreamReader(input));
                StringBuilder result = new StringBuilder();
                String line;

                while ((line = reader.readLine()) != null) {
                    result.append(line);
                }

                // Pass data to onPostExecute method
                return (result.toString());

            } else {

                return ("unsuccessful");
            }

        } catch (IOException e) {
            e.printStackTrace();
            return e.toString();
        } finally {
            conn.disconnect();
        }


    }
    // this method will interact with UI, display result sent from doInBackground method
    @Override
    protected void onPostExecute(String result) {
        myinterface.myJson(result.toString());
        }

    }
