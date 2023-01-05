import React from "react";
import { IoIosColorPalette } from "react-icons/io";
import { TbActivityHeartbeat } from "react-icons/tb";
import { ImLab } from "react-icons/im";
import { CiLogout } from "react-icons/ci";
import { FaDatabase } from "react-icons/fa";

import { Link } from "react-router-dom";

function SideBarSystemDB({ page }) {
  return (
    <div className="h-full pl-[2.20rem] hidden lg:block">
      <div className="bg-white rounded-xl w-fit py-5 px-2 mt-10">
        <Link to="/SystemDashBoard" className="flex flex-col items-center ">
          <IoIosColorPalette
            className={`w-6 h-6  ${
              page === "Colors" ? "text-[#B7C835] " : "text-[#98A2B3]"
            }  `}
          />
          <p
            className={`${
              page === "Colors" ? "text-[#B7C835]" : "text-[#98A2B3]"
            }  text-sm mt-1 font-Poppins-Regular `}
          >
            Colors
          </p>
        </Link>

        <Link
          to="/SystemDashBoard/Analytic"
          className="flex flex-col items-center mt-5"
        >
          <TbActivityHeartbeat
            className={`w-6 h-6 ${
              page === "Analytic" ? "text-[#B7C835]" : "text-[#98A2B3]"
            }  border-2 rounded-md`}
          />
          <p
            className={`${
              page === "Analytic" ? "text-[#B7C835]" : "text-[#98A2B3]"
            } text-sm mt-1 font-Poppins-Regular`}
          >
            Analytic
          </p>
        </Link>

        <Link
          to="/SystemDashBoard/Labs"
          className="flex flex-col items-center mt-5"
        >
          <ImLab
            className={`w-6 h-6  ${
              page === "Labs" ? "text-[#B7C835]" : "text-[#98A2B3]"
            }`}
          />
          <p
            className={`${
              page === "Labs" ? "text-[#B7C835]" : "text-[#98A2B3]"
            } text-sm mt-1 font-Poppins-Regular`}
          >
            Labs
          </p>
        </Link>
        <Link
          to="/SystemDashBoard/Quantity"
          className="flex flex-col items-center mt-5"
        >
          <FaDatabase
            className={`w-6 h-6  ${
              page === "Quantity" ? "text-[#B7C835]" : "text-[#98A2B3]"
            }`}
          />
          <p
            className={`${
              page === "Quantity" ? "text-[#B7C835]" : "text-[#98A2B3]"
            } text-sm mt-1 font-Poppins-Regular`}
          >
            Quantity
          </p>
        </Link>
        <div className="flex flex-col items-center mt-[11.8rem]">
          <CiLogout className="w-6 h-6  text-[#F04438]" />
          <p className="text-[#F04438] text-sm mt-1  font-Poppins-Regular">
            Logout
          </p>
        </div>
      </div>
    </div>
  );
}

export default SideBarSystemDB;
