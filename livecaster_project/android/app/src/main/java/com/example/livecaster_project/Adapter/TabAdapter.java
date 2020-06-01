package com.example.livecaster_project.Adapter;

import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentPagerAdapter;

import com.example.livecaster_project.News_Categories_Fragment;
import com.example.livecaster_project.Recent_News_Fragment;

public class TabAdapter extends FragmentPagerAdapter {



    public TabAdapter(FragmentManager fm) {
        super(fm);

    }

    @Override
    public Fragment getItem(int position) {
    Fragment fragment = null;
        switch (position)
        {
            case 0: fragment = new Recent_News_Fragment();
                    break;
            case 1: fragment = new News_Categories_Fragment();
                    break;
            default:fragment = null;
        }
        return fragment;

    }

    @Override
    public int getCount() {
        return 2;
    }
}