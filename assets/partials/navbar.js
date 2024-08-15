import React from 'react';


const Navbar = ({dataSet}) => {
    return (
        <nav className="navbar p-0 fixed-top d-flex flex-row">
            <div className="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                <a className="navbar-brand brand-logo-mini" href="#"><img src=""
                                                                          alt="logo"/></a>
            </div>
            <div className="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <button className="navbar-toggler navbar-toggler align-self-center" type="button"
                        data-toggle="minimize">
                    <span className="mdi mdi-menu"></span>
                </button>
                <ul className="navbar-nav w-100">
                    <li className="nav-item w-100">
                        <form className="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                            <input type="text" className="form-control" placeholder="Search products"/>
                        </form>
                    </li>
                </ul>
                <ul className="navbar-nav navbar-nav-right">
                    <li className="nav-item dropdown d-none d-lg-block">
                        <a className="nav-link btn btn-success create-new-button" id="createbuttonDropdown"
                           data-toggle="dropdown" aria-expanded="false" href="#">+ Create New Project</a>
                        <div className="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                             aria-labelledby="createbuttonDropdown">
                            <h6 className="p-3 mb-0">Projects</h6>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-file-outline text-primary"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject ellipsis mb-1">Software Development</p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-web text-info"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject ellipsis mb-1">UI Development</p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-layers text-danger"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject ellipsis mb-1">Software Testing</p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <p className="p-3 mb-0 text-center">See all projects</p>
                        </div>
                    </li>
                    <li className="nav-item nav-settings d-none d-lg-block">
                        <a className="nav-link" href="#">
                            <i className="mdi mdi-view-grid"></i>
                        </a>
                    </li>
                    {/*<li className="nav-item nav-settings d-none d-lg-block">*/}
                    {/*    <a className="nav-link count-indicator dropdown-toggle" id="flagDropDown" href="#"*/}
                    {/*       data-toggle="dropdown" aria-expanded="false">*/}
                    {/*        <i className="mdi mdi-flag"></i>*/}
                    {/*        /!*<span className="count bg-success"></span>*!/*/}
                    {/*    </a>*/}
                    {/*    <div className="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"*/}
                    {/*         aria-labelledby="flagDropDown">*/}
                    {/*        <div className="country">*/}
                    {/*            <form method="POST">*/}
                    {/*                <a className="dropdown-item">*/}
                    {/*                {Object.keys(dataSet.languages).map((key, subIndex) => {*/}
                    {/*                    const country = dataSet.languages[key];*/}
                    {/*                    return (*/}
                    {/*                        <img className="country-icon" data--country={`${country.alias}`}*/}
                    {/*                             src={`${country.imagePath}`}*/}
                    {/*                             alt={`${country.name}`}/>*/}
                    {/*                    );*/}
                    {/*                })}*/}
                    {/*                </a>*/}

                    {/*            </form>*/}
                    {/*        </div>*/}
                    {/*    </div>*/}
                    {/*</li>*/}
                    <li className="nav-item dropdown border-left">
                        <a className="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#"
                           data-toggle="dropdown" aria-expanded="false">
                            <i className="mdi mdi-email"></i>
                            <span className="count bg-success"></span>
                        </a>
                        <div className="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                             aria-labelledby="messageDropdown">
                            <h6 className="p-3 mb-0">Messages</h6>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <img src={`${dataSet.imagePath.person1}`} alt="image"
                                         className="rounded-circle profile-pic"/>
                                </div>
                                <div className="preview-item-content">

                                    <p className="preview-subject ellipsis mb-1">Mark send you a message</p>
                                    <p className="text-muted mb-0"> 1 Minutes ago </p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <img src={`${dataSet.imagePath.person2}`} alt="image"
                                         className="rounded-circle profile-pic"/>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject ellipsis mb-1">Cregh send you a message</p>
                                    <p className="text-muted mb-0"> 15 Minutes ago </p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <img src={`${dataSet.imagePath.person3}`} alt="image"
                                         className="rounded-circle profile-pic"/>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject ellipsis mb-1">Profile picture updated</p>
                                    <p className="text-muted mb-0"> 18 Minutes ago </p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <p className="p-3 mb-0 text-center">4 new messages</p>
                        </div>
                    </li>
                    <li className="nav-item dropdown border-left">
                        <a className="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#"
                           data-toggle="dropdown">
                            <i className="mdi mdi-bell"></i>
                            <span className="count bg-danger"></span>
                        </a>
                        <div className="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                             aria-labelledby="notificationDropdown">
                            <h6 className="p-3 mb-0">Notifications</h6>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-calendar text-success"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject mb-1">Event today</p>
                                    <p className="text-muted ellipsis mb-0"> Just a reminder that you have an event
                                        today </p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-settings text-danger"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject mb-1">Settings</p>
                                    <p className="text-muted ellipsis mb-0"> Update dashboard </p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-link-variant text-warning"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject mb-1">Launch Admin</p>
                                    <p className="text-muted ellipsis mb-0"> New admin wow! </p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <p className="p-3 mb-0 text-center">See all notifications</p>
                        </div>
                    </li>
                    <li className="nav-item dropdown">
                        <a className="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                            <div className="navbar-profile">
                                <img className="img-xs rounded-circle" src={`${dataSet.imagePath.portfolio}`}
                                     alt=""/>
                                <p className="mb-0 d-none d-sm-block navbar-profile-name">Henry Klein</p>
                                <i className="mdi mdi-menu-down d-none d-sm-block"></i>
                            </div>
                        </a>
                        <div className="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                             aria-labelledby="profileDropdown">
                            <h6 className="p-3 mb-0">Profile</h6>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-settings text-success"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject mb-1">Settings</p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-logout text-danger"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject mb-1">Log out</p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <p className="p-3 mb-0 text-center">Advanced settings</p>
                        </div>
                    </li>
                </ul>
                <button className="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                        data-toggle="offcanvas">
                    <span className="mdi mdi-format-line-spacing"></span>
                </button>
            </div>
        </nav>
    );
}

export default Navbar;