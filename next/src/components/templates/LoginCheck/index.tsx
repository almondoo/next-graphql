import { useEffect } from 'react';
import CircularProgress from '@mui/material/CircularProgress';
import Box from '@mui/material/Box';
import { useAuth0 } from '@auth0/auth0-react';
import { useRouter } from 'next/router';
import { useSetRecoilState } from 'recoil';
import { userState } from 'recoil/user/atom';
import type { User } from 'models/user';

const IsLogin = (): JSX.Element => {
  const { isAuthenticated, user } = useAuth0();
  const router = useRouter();
  const setUser = useSetRecoilState<User>(userState);
  setTimeout(() => {
    if (!isAuthenticated) {
      // router.replace('login');
      console.log('/loginにredirect');
    }
  }, 3000);

  useEffect(() => {
    if (isAuthenticated && user) {
      console.log(user);
      setUser({
        // @ts-ignore isAuthenticatedがtrueならuserにデータは入る
        name: user.name,
        // @ts-ignore isAuthenticatedがtrueならuserにデータは入る
        email: user.email,
      });

      router.push('/');
    }
  });

  return (
    <Box
      sx={{
        width: '100%',
        height: '100vh',
        display: 'flex',
        justifyContent: 'center',
        alignItems: 'center',
      }}
    >
      <CircularProgress size="80px" />
    </Box>
  );
};

export default IsLogin;
