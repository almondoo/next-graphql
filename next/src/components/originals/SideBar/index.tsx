import { useContext } from 'react';
import styles from './style';
import { SideBarIsOpenContext } from 'context/sideBar';
import Box from '@mui/material/Box';
import Toolbar from '@mui/material/Toolbar';
import List from '@mui/material/List';
import Divider from '@mui/material/Divider';
import ListItem from '@mui/material/ListItem';
import ListItemIcon from '@mui/material/ListItemIcon';
import ListItemText from '@mui/material/ListItemText';
import InboxIcon from '@mui/icons-material/MoveToInbox';
import { Link as MLink } from '@mui/material';
import Link from 'next/link';
import routes from 'utils/route';

const list = [
  {
    name: 'Login',
    link: routes.login,
  },
  {
    name: 'Register',
    link: routes.register,
  },
  {
    name: 'Home',
    link: routes.home,
  },
  {
    name: 'Forgot Password',
    link: routes.forgotPassword,
  },
  {
    name: 'Task List',
    link: routes.taskList,
  },
];

const SideBar = (): JSX.Element => {
  const ctx = useContext(SideBarIsOpenContext);

  return (
    <div>
      <Toolbar />
      <Divider />
      <Box sx={{ width: 250 }} role="presentation" onClick={() => ctx.setState(false)}>
        <List>
          {list.map((v, i) => (
            <li key={i}>
              <ListItem button>
                <Link href={v.link} passHref>
                  <MLink color="inherit" sx={styles.listLink}>
                    <ListItemIcon>
                      <InboxIcon />
                    </ListItemIcon>
                    <ListItemText primary={v.name} />
                  </MLink>
                </Link>
              </ListItem>
            </li>
          ))}
        </List>
        <Divider />
      </Box>
    </div>
  );
};

export default SideBar;
