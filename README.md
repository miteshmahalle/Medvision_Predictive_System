# MedVision Predictive System

MedVision is a machine learning-powered web application designed to assist in the early prediction of multiple human diseases. It features an easy-to-use interface and supports prediction for **Diabetes**, **Heart Disease**, and **Parkinson’s Disease**.

## 🔍 Features

- ✅ Predicts three major diseases using trained ML models:
  - **Diabetes**
  - **Heart Disease**
  - **Parkinson's Disease**
- 🧠 Uses algorithms like:
  - Support Vector Machine (SVM)
  - Logistic Regression
  - Random Forest
- 🌐 Web frontend built using **Streamlit** for interactive user input
- 🗃 Organized modular code structure
- ⚙️ Backend ready for integration with Flask for full-stack deployment

## 📁 Project Structure

medvision-predictive-system/
│
├── multiple-disease-prediction/
│ ├── pages/
│ │ ├── diabetes.py
│ │ ├── heart.py
│ │ └── parkinsons.py
│ ├── dataset/
│ │ ├── diabetes.csv
│ │ ├── heart.csv
│ │ └── parkinsons.csv
│ ├── models/
│ │ ├── diabetes_model.sav
│ │ ├── heart_model.sav
│ │ └── parkinsons_model.sav
│ └── app.py
│
└── README.md

bash
Copy
Edit

## 🚀 How to Run the Project

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/MedVision_Predictive_System.git
   cd MedVision_Predictive_System
Install required Python libraries:

bash
Copy
Edit
pip install -r requirements.txt
Run the Streamlit app:

bash
Copy
Edit
streamlit run app.py
Make sure the CSV datasets and trained models are available in the correct folders.

📌 Technologies Used
Python

Streamlit

Scikit-learn

Pandas / NumPy

Machine Learning (SVM, Logistic Regression, Random Forest)

👥 Contributors
Mitesh Mahalle
Kush Fule<img width="1366" height="768" alt="Screenshot (18)" src="https://github.com/user-attachments/assets/2f3ac858-07f7-4d92-99cf-7b168901b814" />
<img width="1366" height="768" alt="Screenshot (17)" src="https://github.com/user-attachments/assets/bade6c48-3d3e-46f5-b3c1-3e8fb06aa753" />


📄 License
This project is licensed under the MIT License.
