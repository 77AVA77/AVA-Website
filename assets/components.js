import React from 'react';

function componentSwitch(page) {
    switch (page) {
        case 'index':
            return <Main/>
        case 'login':
            return <Login/>
        case 'register':
            return <Register/>
        case 'users':
            return <Users/>
        default:
            return <Main/>
    }
}

const Components = ({ component }) => {
    const PageComponent = componentSwitch(component);
    return <PageComponent/>;
};

export default Components;
//
// const chartTypeList = [
//     'line',
//     'bar',
//     'area',
//     'doughnut',
//     'pie',
//     'scatter',
//     'multi-line',
//     'multi-area',
//     'browserTraffic'
// ];
//
// for (let i = 0; i < chartTypeList.length; i++) {
//     if (document.querySelector('#' + chartTypeList[i] + 'Chart')) {
//         // Your logic here
//     }
// }
//
// class Chart extends React.Component {
//
//     render() {
//         return (
//             <div className="col-lg-6 grid-margin stretch-card">
//                 <div className="card">
//                     <div className="card-body">
//                         <h4 className="card-title">{chartType} chart</h4>
//                         <canvas id={`${chartType}`} aria-current="page"></canvas>
//                     </div>
//                 </div>
//             </div>
//         );
//     }
// }
//
// class SignUp extends React.Component {
//     renderSwitch(param) {
//         switch (param) {
//             case 'foo':
//                 return 'bar';
//             default:
//                 return 'foo';
//         }
//     }
//
//     render() {
//         return (
//             <div className="container-scroller">
//                 <div className="container-fluid page-body-wrapper full-page-wrapper">
//                     <div className="row w-100 m-0">
//                         <div className="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
//                             <div className="card col-lg-4 mx-auto">
//                                 <div className="card-body px-5 py-5">
//                                     <h3 className="card-title text-left mb-3">Login</h3>
//                                     <form>
//                                         <div className="form-group">
//                                             <label>Username or email *</label>
//                                             <input type="text" className="form-control p_input"/>
//                                         </div>
//                                         <div className="form-group">
//                                             <label>Password *</label>
//                                             <input type="text" className="form-control p_input"/>
//                                         </div>
//                                         <div className="form-group d-flex align-items-center justify-content-between">
//                                             <div className="form-check">
//                                                 <label className="form-check-label">
//                                                     <input type="checkbox" className="form-check-input"/> Remember me
//                                                 </label>
//                                             </div>
//                                             <a href="#" className="forgot-pass">Forgot password</a>
//                                         </div>
//                                         <div className="text-center">
//                                             <button type="submit"
//                                                     className="btn btn-primary btn-block enter-btn">Login
//                                             </button>
//                                         </div>
//                                         <div className="d-flex">
//                                             <button className="btn btn-facebook mr-2 col">
//                                                 <i className="mdi mdi-facebook"></i> Facebook
//                                             </button>
//                                             <button className="btn btn-google col">
//                                                 <i className="mdi mdi-google-plus"></i> Google plus
//                                             </button>
//                                         </div>
//                                         <p className="sign-up">Don't have an Account?<a href="#"> Sign Up</a></p>
//                                     </form>
//                                 </div>
//                             </div>
//                         </div>
//                     </div>
//                 </div>
//             </div>
//         );
//     }
// }


