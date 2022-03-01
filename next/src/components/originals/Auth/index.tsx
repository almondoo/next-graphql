import { ReactNode, useEffect } from 'react';
import { useAuth0 } from '@auth0/auth0-react';
import { useRouter } from 'next/router';

type Props = {
  children: ReactNode;
};

const Auth = ({ children }: Props): JSX.Element => {
  const router = useRouter();
  const { isAuthenticated } = useAuth0();

  useEffect(() => {
    if (!isAuthenticated) {
      router.push('/login');
    }
  });

  return <>{children}</>;
};

export default Auth;
