package solutions.a611.prodrivetime;

import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.util.List;

import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.Response;
import okhttp3.ResponseBody;

import static solutions.a611.prodrivetime.LoginActivity.driver__email;

class CustomAdapter extends RecyclerView.Adapter<CustomAdapter.ViewHolder>{

    private Context context;
    private List<MyData> my_data;
    private Button accept;



    public CustomAdapter(Context context, List<MyData> my_data) {
        this.context = context;
        this.my_data = my_data;
    }

    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull final ViewGroup parent, final int viewType) {

        // Now we will reference the cardView layout with this inflater
        final View itemView = LayoutInflater.from(parent.getContext()).inflate(R.layout.card,parent,false);

        //CONNECTING THE BUTTON
        accept = (Button)itemView.findViewById(R.id.accept);




        //returning the item
        return new ViewHolder(itemView);
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder holder, final int position) {

        //applying the text to the text views
        holder.business.setText(my_data.get(position).getBusiness());
        holder.details.setText(my_data.get(position).getDetails());
        holder.amount_offered.setText(my_data.get(position).getAmount_offered());

        //SETTING THE ONCLICK LISTENER FOR THE ACCEPT BUTTON
        accept.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                AsyncTask<String,Void,Void> accept = new AsyncTask<String, Void, Void>() {
                    @Override
                    protected Void doInBackground(String... strings) {
                        //sending a request for information to our server
                        OkHttpClient client = new OkHttpClient();
                        Request request = new Request.Builder()
                                //add the url pointing to acceptRequests.php in your custom URL
                                .url("https://drivetimepro1.000webhostapp.com/apps/android/acceptRequests.php?id="+my_data.get(position).getId()+"&client_email="+my_data.get(position).getClient_email()+"&client_name="+my_data.get(position).getClient_name()+"&business="+my_data.get(position).getBusiness()+"&details="+my_data.get(position).getDetails()+"&amount_offered="+my_data.get(position).getAmount_offered()+"&driver_email="+driver__email)
                                .build();

                        try {
                            //EXECUTING THE REQUEST
                            Response response = client.newCall(request).execute();
                            System.out.println(response);
                        } catch (IOException e) {
                            e.printStackTrace();
                        }

                        return null;
                    }

                    @Override
                    protected void onPostExecute(Void aVoid) {
                        Toast.makeText(context,"Card Accepted",Toast.LENGTH_LONG).show();



                    }
                };
                //EXECUTING THE REQUEST
                accept.execute();
            }
        });
    }

    @Override
    public int getItemCount() {

        //returning the size of the list we provide
        return my_data.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        public TextView business,details,amount_offered;

        public ViewHolder(View itemView) {
            super(itemView);
            business = (TextView) itemView.findViewById(R.id.business);
            details = (TextView) itemView.findViewById(R.id.details);
            amount_offered = (TextView) itemView.findViewById(R.id.amount_offered);
        }
    }

    //THE METHOD TO ACCEPT THE CARD
    public void acceptCard(){


    }
}
