import React, { useEffect, useState } from "react";
import { AiOutlineClose } from "react-icons/ai";
import { IoTrashOutline } from "react-icons/io5";

import "react-datepicker/dist/react-datepicker.css";
import { Link } from "react-router-dom";
import { VscListFlat } from "react-icons/vsc";
import SideBarSystemDB from "./components/SystemDashBoard/SideBarSystemDB";
import { TiEdit } from "react-icons/ti";
import HeaderSystemDB from "./components/SystemDashBoard/HeaderSystemDB";
import axios from "axios";

function SystemDashBoard() {
  const [Content, setContent] = useState();
  function drawer() {
    document.getElementById("drawerBody").classList.remove("hidden");
    document
      .getElementById("drawerBody")
      .classList.add(
        "flex",
        "fixed",
        "h-screen",
        "w-full",
        "bg-transparent",
        "top-0",
        "left-0",
        "lg:hidden",
        "z-10"
      );
  }
  function closeDrawer() {
    document.getElementById("drawerBody").classList.add("hidden");
  }
  useEffect(() => {
    GetTupes();
  }, []);

  const GetTupes = async () => {
    let token =
      "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMTY5OWYxMzk1ZTYwMDAyOGQwNjdkYWY0NzYyYTQwYTZlMzRlOGIzMTY0NTA3N2U4ZWVlZmY0YjFiZWM4Y2EzZmNlZGFiN2I4ZTMyZjkwYTIiLCJpYXQiOjE2NzI5MjE4MzguNzI3ODU2LCJuYmYiOjE2NzI5MjE4MzguNzI3ODYxLCJleHAiOjE3MDQ0NTc4MzguNzIwODk4LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Jldigf2wddB-gCZpikAXlW4wRHO9JRtEjhKiJ1QyaKzE8g3UFgDdB7P-oHebd_4EoNES9X0hi4RLOnTbTjmxpFXpMtyhw6K3IYEQu3iumDPRn5s9aqOFbr2DRerGZ4notqahEDElM1Re1iPNskbgDGx4WBsmU1s7XEYVGFxtJtsRtdJ1wGGduMJ3PtDh6nyeMQI_RgkmjNxhCPLM_VtI1RxK5j9X2cb_UpYdHMhcJUXxwGNdvPtZub3oMFujG8dk3yNjcrl1AvTCp7BGsPRL8lOO0b_rDadzwfemfmAdeBuZpsDq4AexVISuKSBN1vdpWBUW5Auit_MVeLRT854zRYQaGF75PZS70louGWAehr0J8aBwDzHdu56CyN1X8SWCWZJ0lIgnjqDyc609zb7YnoS5a2zaQm17TMmd8B4-qw1pwdq11zHnwFF3c9jH7Zkq436r2skioLIKOC8u0J-0U4qnZ5i-TkQtkiXXQbufLjx5XtSa1SBgzZP3p6OQwi_JmiFC5xbmjnUQwPMoziHm23ro6rcK2L6Mqw7OaO2eG3hQ1bC4OdYGrZy_YyzbcbU-sqOl3E00kdkktuk9ZCdKnw0DTg67wXQ9C0LfYmQ_MiAcgWjM9HkcUEDKnj5z15yICsONfGZC0WDf6P2MRdVVhkg6FEORxAZLOsL9Tv0pyNQ";
    await axios
      .get(`https://aurora-team.com/labs-obada/api/admin-scope/tupes`, {
        headers: {
          "Content-type": "application/json",
          Authorization: "Bearer " + token,
        },
      })
      .then((response) => {
        setContent(response.data);
      });
  };
  const AddToTable = () => {
    let Data = {};
  };
  return (
    <div className="w-full h-full pr-5 p-5">
      <div className="w-full flex ">
        <div className="bg-white mr-[-1rem] lg:mr-0 rounded-l-xl ">
          <VscListFlat
            id="drawerbtn"
            className="text-black  text-xl m-2  cursor-pointer w-10 h-20 lg:hidden "
            onClick={() => drawer()}
          />
        </div>
        <HeaderSystemDB />
      </div>
      <div className="flex ">
        <SideBarSystemDB page="Colors" />
        <div className="w-full h-full lg:ml-8 mt-10 pb-48">
          {/* Pangration */}
          <div className={`  mt-10 mb-10`}>
            <div className="flex w-full justify-between space-x-10 col-start-1 col-end-3">
              <div className="border-[#E4E7EC] w-[50%] h-fit bg-[#F9FAFF] flex space-x-2 items-center py-3 px-4  relative border-[1px] rounded-xl ">
                <input
                  id="Color"
                  placeholder="Color"
                  type="text"
                  className="w-full bg-[#F9FAFF] font-Poppins-Medium text-xs placeholder:text-[#98A2B3] outline-0 ring-0"
                />
              </div>
              <div className=" bg-[#0D2135] w-[30%] lg:w-[20%]  flex items-center justify-center px-5 lg:px-10  py-2 rounded-xl cursor-pointer ">
                <p
                  className="text-sm flex items-center justify-center text-white font-Poppins-Medium"
                  onClick={() => AddToTable()}
                >
                  Add to table
                </p>
              </div>
            </div>

            <table className="w-full h-full mt-5  bg-white  rounded-2xl col-start-1 col-end-3 ">
              <tr className="border-b-[1px] w-full">
                <td className="text-sm text-[#98A2B3] font-Poppins-Regular py-1 pl-8 w-[85%]">
                  Color
                </td>
                <td className="text-sm text-[#98A2B3] font-Poppins-Regular py-1 w-[15%]">
                  Action
                </td>
              </tr>
              {Content?.data.length !== 0
                ? Content?.data.map((tupe) => (
                    <tr className="border-b-[1px] w-full">
                      <td className="text-sm text-[#101828] font-semibold font-Poppins-Regular py-1 pl-8 ">
                        {tupe.tupe}
                      </td>
                      <td className="text-sm text-[#101828] font-semibold font-Poppins-Regular py-1 ">
                        <div className="flex space-x-2 ">
                          <TiEdit className="text-2xl  opacity-50 cursor-pointer" />
                          <IoTrashOutline className="text-2xl text-[#F04438] cursor-pointer" />
                        </div>
                      </td>
                    </tr>
                  ))
                : "Loading"}
            </table>
          </div>
          {/* Drawer */}
          <div id="drawerBody" className=" hidden  ">
            <div
              id="drawer"
              className=" w-full bg-[#0D2135] opacity-80 h-full md:w-1/2"
            >
              <div className="p-4">
                <AiOutlineClose
                  className="text-xl text-white cursor-pointer "
                  onClick={() => closeDrawer()}
                />
              </div>
              <div className="flex flex-col ml-10 md:ml-20 space-y-1 w-full justify-center  h-4/5 text-white ">
                {/* border-b-2 border-[#847244] */}
                <Link
                  to="/SystemDashBoard"
                  className="hover:bg-black rounded-xl cursor-pointer flex justify-center  text-xl  p-2 md:w-1/2 w-3/4"
                >
                  <div className="font-Poppins-Regular text-sm">Colors</div>
                </Link>
                <Link
                  to="/SystemDashBoard/Analytic"
                  className="hover:bg-black rounded-xl cursor-pointer flex justify-center md:w-1/2 w-3/4  text-xl p-2 "
                >
                  <div className="font-Poppins-Regular text-sm">Analytic </div>
                </Link>
                <Link
                  to="/SystemDashBoard/Labs"
                  className="hover:bg-black rounded-xl cursor-pointer flex justify-center md:w-1/2 w-3/4   text-xl p-2"
                >
                  <div className="font-Poppins-Regular text-sm">Labs </div>
                </Link>
                <Link
                  to="/SystemDashBoard/Quantity"
                  className="hover:bg-black rounded-xl cursor-pointer flex justify-center md:w-1/2 w-3/4   text-xl p-2"
                >
                  <div className="font-Poppins-Regular text-sm">Quantity </div>
                </Link>
                <Link
                  to="/SystemDashBoard"
                  className="hover:bg-black rounded-xl cursor-pointer flex justify-center md:w-1/2 w-3/4  text-xl p-2"
                >
                  <div className="font-Poppins-Regular text-sm">Logout</div>
                </Link>
              </div>
            </div>
            <div className="hidden sm:block h-full w-full bg-black opacity-40" />
          </div>
        </div>
      </div>
    </div>
  );
}

export default SystemDashBoard;
