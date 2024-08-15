import React from 'react';


function Sidebar ({ dataSet }) {
    const { list } = dataSet;

    const menuItems = Object.entries(list).map(([key, item]) => {
        // Check if the item has a subMenu
        if (item.subMenu) {
            return (
                    <li className="nav-item menu-items" key={key}>
                        <a className="nav-link" data-toggle="collapse" href={`#collapse-${key}`} aria-expanded="false"
                           aria-controls={`collapse-${key}`}>
                        <span className="menu-icon">
                            <i className={`mdi mdi-${item.icon}`}></i>
                        </span>
                            <span className="menu-title">{item.name}</span>
                            <i className="menu-arrow"></i>
                        </a>
                        <div className="collapse" id={`collapse-${key}`}>
                            <ul className="nav flex-column sub-menu">
                                {Object.keys(item.subMenu).map((key, subIndex) => {
                                    const subItem = item.subMenu[key];
                                    return (
                                        <li className="nav-item" key={subIndex}>
                                            <a className="nav-link" href={subItem.path}>{subItem.name}</a>
                                        </li>
                                    );
                                })}
                            </ul>
                        </div>
                    </li>
            );
        } else {
            return (
                <li className="nav-item menu-items">
                    <a className="nav-link" href={item.path}>
                    <span className="menu-icon">
                        <i className={`mdi mdi-${item.icon}`}></i>
                    </span>
                        <span className="menu-title">{item.name}</span>
                    </a>
                </li>

            );
        }
    });

    return (
        <nav className="sidebar sidebar-offcanvas" id="sidebar">
            <div className="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <a className="sidebar-brand brand-logo" href="/"><img src={`${dataSet.imagePath.logo}`} alt="logo"/></a>
                <a className="sidebar-brand brand-logo-mini" href="/"><img src={`${dataSet.imagePath.logo}`} alt="logo"/></a>
            </div>
            <ul className="nav">
                <li className="nav-item profile">
                    <div className="profile-desc">
                        <div className="profile-pic">
                            <div className="count-indicator">
                                <img className="img-xs rounded-circle " src={`${dataSet.imagePath.portfolio}`} alt=""/>
                                <span className="count bg-success"></span>
                            </div>
                            <div className="profile-name">
                                <h5 className="mb-0 font-weight-normal">Henry Klein</h5>
                                <span>Gold Member</span>
                            </div>
                        </div>
                        <a href="#" id="profile-dropdown" data-toggle="dropdown"><i
                            className="mdi mdi-dots-vertical"></i></a>
                        <div className="dropdown-menu dropdown-menu-right sidebar-dropdown preview-list"
                             aria-labelledby="profile-dropdown">
                            <a href="#" className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-settings text-primary"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject ellipsis mb-1 text-small">Account settings</p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a href="#" className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-onepassword  text-info"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject ellipsis mb-1 text-small">Change Password</p>
                                </div>
                            </a>
                            <div className="dropdown-divider"></div>
                            <a href="#" className="dropdown-item preview-item">
                                <div className="preview-thumbnail">
                                    <div className="preview-icon bg-dark rounded-circle">
                                        <i className="mdi mdi-calendar-today text-success"></i>
                                    </div>
                                </div>
                                <div className="preview-item-content">
                                    <p className="preview-subject ellipsis mb-1 text-small">To-do list</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </li>
                <li className="nav-item nav-category">
                    <span className="nav-link">Navigation</span>
                </li>
                {menuItems}
            </ul>
        </nav>
    );
}

export default Sidebar;