package solutions.a611.prodrivetime;

import android.content.Context;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import static solutions.a611.prodrivetime.LoginActivity.driver__city;
import static solutions.a611.prodrivetime.LoginActivity.driver__email;
import static solutions.a611.prodrivetime.LoginActivity.driver__experience;
import static solutions.a611.prodrivetime.LoginActivity.driver__name;
import static solutions.a611.prodrivetime.LoginActivity.driver__number;


/**
 * A simple {@link Fragment} subclass.
 * Activities that contain this fragment must implement the
 * {@link driveHomeFragment.OnFragmentInteractionListener} interface
 * to handle interaction events.
 * Use the {@link driveHomeFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class driveHomeFragment extends Fragment {
    String driverName;
    TextView driver_name,driver_email,driver_number,driver_city,driver_experience;

    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    private OnFragmentInteractionListener mListener;

    public driveHomeFragment() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment driveHomeFragment.
     */
    // TODO: Rename and change types and number of parameters
    public static driveHomeFragment newInstance(String param1, String param2) {
        driveHomeFragment fragment = new driveHomeFragment();
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

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_drive_home, container, false);

        //setting the textviews to hold the account data
        driver_name = (TextView) view.findViewById(R.id.driver_name);
        driver_email = (TextView) view.findViewById(R.id.driver_email);
        driver_number = (TextView) view.findViewById(R.id.driver_number);
        driver_city = (TextView) view.findViewById(R.id.driver_city);
        driver_experience = (TextView) view.findViewById(R.id.driver_experience);

        //profile will pull account information from the static variables set in the Login Activity Class
        //the account information be displayed on the account page
        driver_name.setText(driver__name);
        driver_email.setText(driver__email);
        driver_number.setText(driver__number);
        driver_city.setText(driver__city);
        driver_experience.setText(driver__experience);

        return view;
    }

    // TODO: Rename method, update argument and hook method into UI event
    public void onButtonPressed(Uri uri) {
        if (mListener != null) {
            mListener.onFragmentInteraction(uri);
        }
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

    /**
     * This interface must be implemented by activities that contain this
     * fragment to allow an interaction in this fragment to be communicated
     * to the activity and potentially other fragments contained in that
     * activity.
     * <p>
     * See the Android Training lesson <a href=
     * "http://developer.android.com/training/basics/fragments/communicating.html"
     * >Communicating with Other Fragments</a> for more information.
     */
    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(Uri uri);
    }
}
