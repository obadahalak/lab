import "./App.css";
import Home from "./Home";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Settings from "./Settings";
import SuppliersOfficeName from "./SuppliersOfficeName";
import SuppliersPaidBills from "./SuppliersPaidBills";
import Staff from "./Staff";
import EditEmployee from "./EditEmployee";
import Analytic from "./Analytic";
import Patients from "./Patients";
import Store from "./Store";
import Labs from "./Labs";
import Doctors from "./Doctors";
import Reports from "./Reports";
import SystemSettings from "./SystemSettings";
import BasicPlugins from "./BasicPlugins";
import Login from "./Login";
import Accounting from "./Accounting";
import DoctorDashBoard from "./DoctorDashBoard";
import SystemDashBoard from "./SystemDashBoard";
import LabsSystemDB from "./SystemDashBoard/LabsSystemDB";
import AnalyticSystemDB from "./SystemDashBoard/AnalyticSystemDB";
import QuantitySystemDB from "./SystemDashBoard/QuantitySystemDB";
import { QueryClient, QueryClientProvider, useQuery } from "react-query";

const queryClient = new QueryClient();
function App() {
  return (
    <div className="bg-[#F2F4F7] h-full w-full  ">
      <Router>
        <Routes>
          <Route path="/DoctorDashBoard" element={<DoctorDashBoard />} />
          <Route path="/SystemDashBoard" element={<SystemDashBoard />} />
          <Route
            path="/SystemDashBoard/Labs"
            element={
              <QueryClientProvider client={queryClient}>
                <LabsSystemDB />
              </QueryClientProvider>
            }
          />
          <Route
            path="/SystemDashBoard/Analytic"
            element={<AnalyticSystemDB />}
          />
          <Route
            path="/SystemDashBoard/Quantity"
            element={<QuantitySystemDB />}
          />
          <Route path="/" element={<Home />} />
          <Route path="/Login" element={<Login />} />
          <Route path="/Accounting" element={<Accounting />} />
          <Route path="/Settings" element={<Settings />} />
          <Route path="/Suppliers" element={<SuppliersOfficeName />} />
          <Route path="/Suppliers/PaidBills" element={<SuppliersPaidBills />} />
          <Route path="/Staff" element={<Staff />} />
          <Route path="/Staff/EditEmployee" element={<EditEmployee />} />
          <Route path="/Analytic" element={<Analytic />} />
          <Route path="/Patients" element={<Patients />} />
          <Route path="/Store" element={<Store />} />
          <Route path="/Labs" element={<Labs />} />
          <Route path="/Doctors" element={<Doctors />} />
          <Route path="/Reports" element={<Reports />} />
          <Route path="/Settings/SystemSettings" element={<SystemSettings />} />
          <Route path="/Settings/BasicPlugins" element={<BasicPlugins />} />
        </Routes>
      </Router>
    </div>
  );
}

export default App;
