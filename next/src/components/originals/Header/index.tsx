import { useState } from 'react';
import AppBar from '@mui/material/AppBar';
import Toolbar from '@mui/material/Toolbar';
import Typography from '@mui/material/Typography';
import Button from '@mui/material/Button';
import IconButton from '@mui/material/IconButton';
import MenuIcon from '@mui/icons-material/Menu';
import Drawer from '@mui/material/Drawer';
import Link from 'next/link';
import { useAuth0 } from '@auth0/auth0-react';
import routes from 'utils/route';
import { useRecoilValue } from 'recoil';
import { pageTitle } from 'recoil/title/atom';
import SideBar from 'components/originals/SideBar/index';
import { SideBarIsOpenContext, useSideBarIsOpen } from 'context/sideBar';

const Header = (): JSX.Element => {
  const ctx = useSideBarIsOpen();
  const { isAuthenticated, logout } = useAuth0();
  const title = useRecoilValue<string>(pageTitle);

  const handleDrawer = (open: boolean): void => {
    ctx.setState(open);
  };

  return (
    <AppBar position="fixed">
      <Toolbar>
        <IconButton size="large" edge="start" color="inherit" aria-label="menu" onClick={() => handleDrawer(true)}>
          <MenuIcon />
        </IconButton>
        <SideBarIsOpenContext.Provider value={ctx}>
          <Drawer anchor="left" open={ctx.isOpen} onClose={() => handleDrawer(false)}>
            <SideBar />
          </Drawer>
        </SideBarIsOpenContext.Provider>
        <Typography variant="h6" component="div" sx={{ flexGrow: 1 }}>
          {title}
        </Typography>
        {!isAuthenticated ? (
          <Link href={routes.login} passHref>
            <Button href="/" color="inherit">
              Login
            </Button>
          </Link>
        ) : (
          <Button
            color="inherit"
            onClick={() => logout({ returnTo: process.env['NEXT_PUBLIC_AUTH0_LOGOUT_REDIRECT'] })}
          >
            Logout
          </Button>
        )}
      </Toolbar>
    </AppBar>
  );
};

export default Header;
