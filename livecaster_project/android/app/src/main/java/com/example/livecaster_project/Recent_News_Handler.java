package com.example.livecaster_project;

public class Recent_News_Handler implements MyJson {
    Recent_News_Handler(String urlString)
    {
        AsyncRetrieve a = new AsyncRetrieve(urlString,Recent_News_Handler.this);
        a.execute();
    }

    @Override
    public void myJson(String result) {

    }
}
