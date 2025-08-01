import numpy as np
import pandas as pd
import os
import pickle
import streamlit as st
from sklearn.model_selection import train_test_split
from sklearn import svm
from sklearn.metrics import accuracy_score

working_dir = os.path.dirname(os.path.abspath(__file__))

# Page Configuration (Removing Sidebar)
st.set_page_config(page_title="Diabetes Prediction", layout="centered")

# Hide Sidebar Completely
st.markdown("""
    <style>
        [data-testid="stSidebar"] {
            display: none;
        }
    </style>
""", unsafe_allow_html=True)

# Home Button (Top Right)
col1, col2 = st.columns([8, 1])

with col2:
    if st.button("Home", key="home_btn", help="Go to MedVision's Predictive System", use_container_width=True, type="primary"):
        st.switch_page("app.py")

# Title
st.markdown("<h1 style='text-align: center; color: #ff4c4c;'>Diabetes Prediction</h1>", unsafe_allow_html=True)
st.markdown("<p style='text-align: center; color: #666;'>Enter your details below to check if you are diabetic.</p>", unsafe_allow_html=True)

# Load dataset and train model
# New
diabetes_csv_path = os.path.abspath(os.path.join(working_dir, "..", "dataset", "diabetes.csv"))

try:
    diabetes_dataset = pd.read_csv(diabetes_csv_path)
except FileNotFoundError:
    st.error(f"Error: File not found at {diabetes_csv_path}. Please check the file location.")
    st.stop()

# Data Preparation
X = diabetes_dataset.drop(columns='Outcome', axis=1)
Y = diabetes_dataset['Outcome']
X_train, X_test, Y_train, Y_test = train_test_split(X, Y, test_size=0.2, stratify=Y, random_state=2)

# Train the Model
classifier = svm.SVC(kernel='linear')
classifier.fit(X_train, Y_train)

# Save the trained model
model_filename = os.path.join(working_dir, "diabetes_model.sav")
pickle.dump(classifier, open(model_filename, 'wb'))

# Load the trained model
loaded_model = pickle.load(open(model_filename, 'rb'))

# User Inputs with Defined Ranges and Initial Value as Zero
pregnancies = st.number_input("Number of Pregnancies", min_value=0, max_value=20, value=0, step=1)
glucose = st.number_input("Glucose Level (0-300 mg/dL)", min_value=0, max_value=300, value=0)
blood_pressure = st.number_input("Blood Pressure (0-250 mmHg)", min_value=0, max_value=250, value=0)
skin_thickness = st.number_input("Skin Thickness (0-50 mm)", min_value=0, max_value=50, value=0)
insulin = st.number_input("Insulin Level (0-100 microU/mL)", min_value=0, max_value=100, value=0)
bmi = st.number_input("BMI Value (0-50 kg/m²)", min_value=0.0, max_value=50.0, value=0.0, step=0.1)
dpf = st.number_input("Diabetes Pedigree Function (0-3.0)", min_value=0.0, max_value=3.0, value=0.0, step=0.01)
age = st.number_input("Age of the Person", min_value=1, max_value=120, value=1)

# Button to Predict (Only Enables When All Inputs Are Filled)
if all([glucose, blood_pressure, skin_thickness, insulin, bmi, dpf, age]):
    if st.button("Test the Result 🚀"):
        input_data = np.array([pregnancies, glucose, blood_pressure, skin_thickness, insulin, bmi, dpf, age]).reshape(1, -1)
        prediction = loaded_model.predict(input_data)

        # Display Prediction Result
        if prediction[0] == 0:
            st.success("✅ The person is NOT diabetic!")
        else:
            st.error("⚠️ The person IS diabetic!")
else:
    st.warning("Please enter all values before testing the result.")

# Footer
st.markdown("<p style='text-align: center; color: #aaa;'>Made with ❤️ using Machine Learning</p>", unsafe_allow_html=True)
