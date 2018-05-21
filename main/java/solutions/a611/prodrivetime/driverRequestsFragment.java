package solutions.a611.prodrivetime;

import android.content.Context;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.GridLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;


import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;

import static solutions.a611.prodrivetime.LoginActivity.driver__email;


public class driverRequestsFragment extends Fragment {
    private RecyclerView recyclerView;
    private GridLayoutManager gridLayoutManager;
    private CustomAdapter adapter;
    private List<MyData> data_list;

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    private OnFragmentInteractionListener mListener;

    public driverRequestsFragment() {
        // Required empty public constructor
    }

    // TODO: Rename and change types and number of parameters
    public static driverRequestsFragment newInstance(String param1, String param2) {
        driverRequestsFragment fragment = new driverRequestsFragment();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
        }


    }

    //the parameter id represents the id of the latest visible data item
    private void load_data_from_server(final int id) {
        AsyncTask<Integer,Void,Void> task = new AsyncTask<Integer, Void, Void>() {
            @Override
            protected Void doInBackground(Integer... integers) {
                //sending a request for information to our server
                OkHttpClient client = new OkHttpClient();
                Request request = new Request.Builder()
                        //add the url pointing to readRequests.php in your custom URL
                        .url("https://drivetimepro1.000webhostapp.com/apps/android/readRequests.php?id="+id+"&username="+driver__email)
                        .build();
                //receiving a response from our server in a json format
                            System.out.println(request);
                try {
                    Response response = client.newCall(request).execute();

                    //storing the body of our response in a json array
                    JSONArray array = new JSONArray(response.body().string());

                    //looping through the data from the JSON array
                    for(int i = 0; i < array.length(); i++){
                        //declaring the JSON Object
                        JSONObject object = array.getJSONObject(i);

                        //new data item instance to parse each object by calling the my data class
                        MyData data = new MyData(object.getInt("id"),
                                object.getString("client_email"),object.getString("client_name"),
                                object.getString("business"),object.getString("details"),
                                object.getString("amount_offered"),object.getString("driveremail"),
                                object.getString("timestamp"));

                        //now we will add the data item to our list
                        data_list.add(data);
                    }
                }

                // the statements below will catch any exceptions
                catch (IOException e) {
                    e.printStackTrace();
                }

                catch (JSONException e) {
                    System.out.println("End of the content");
                }

                return null;
            }

            @Override
            protected void onPostExecute(Void aVoid) {

                //will tell the custom adapter that there has
                // been a change and to load new data list
                adapter.notifyDataSetChanged();
            }
        };
        task.execute(id);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        final View view = inflater.inflate(R.layout.fragment_driver_requests, container, false);
        //start of my code
        recyclerView = (RecyclerView)view.findViewById(R.id.requests);
        data_list = new ArrayList<>();
        load_data_from_server(0);

        //Determines how many columns are in the grid
        gridLayoutManager = new GridLayoutManager(getContext(),1);
        recyclerView.setLayoutManager(gridLayoutManager);

        //custom adapter instance to bind data to recycler view
        adapter = new CustomAdapter(getContext(),data_list);
        recyclerView.setAdapter(adapter);

        //we will add an onScroll listener to load new objects when scroll is detected
        recyclerView.addOnScrollListener(new RecyclerView.OnScrollListener() {
            @Override
            public void onScrolled(RecyclerView recyclerView, int dx, int dy) {

                //if the last visible item is reached load 4 more
                if(gridLayoutManager.findLastCompletelyVisibleItemPosition() == data_list.size()-1){
                    //making another request to load 4 more objects
                    load_data_from_server(data_list.get(data_list.size()-1).getId());

                }
            }
        });
        return view;
    }

    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        if (context instanceof OnFragmentInteractionListener) {
            mListener = (OnFragmentInteractionListener) context;
        } else {
            throw new RuntimeException(context.toString()
                    + " must implement OnFragmentInteractionListener");
        }
    }

    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }

    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(Uri uri);
    }


}
