package com.example.livecaster_project;

import android.os.Bundle;

import androidx.appcompat.app.AppCompatActivity;
import androidx.viewpager.widget.ViewPager;

import com.example.livecaster_project.Adapter.TabAdapter;
import com.google.android.material.tabs.TabLayout;

public class Home extends AppCompatActivity {

    private TabAdapter adapter;
    private TabLayout tab;
    private ViewPager viewPager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate( savedInstanceState );
        setContentView( R.layout.activity_home );

        viewPager =  findViewById(R.id.viewPager);
        tab = findViewById(R.id.tabLayout);

        tab.addTab(tab.newTab().setText("Recent News"));
        tab.addTab(tab.newTab().setText("Categories"));



        adapter = new TabAdapter(getSupportFragmentManager());
        viewPager.setAdapter(adapter);
        viewPager.setOffscreenPageLimit(1);
        viewPager.addOnPageChangeListener(new TabLayout.TabLayoutOnPageChangeListener(tab));
    }
}
