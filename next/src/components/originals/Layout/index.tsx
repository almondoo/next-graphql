import { ReactNode } from 'react';
import Style from './style';
import Head from 'next/head';
import Header from 'components/originals/Header/index';
import { useRouter } from 'next/router';

type Props = {
  children: ReactNode;
};

const Layout = ({ children }: Props): JSX.Element => {
  const router = useRouter();

  return (
    <div>
      <Head>
        <meta property="og:type" content="article" />
        <meta property="og:site_name" content="next-GraphQL" />
        <meta property="og:locale" content="ja_JP" />
        {/* <link rel="icon" href="/favicon.png" type="image/png" /> */}
      </Head>
      {router.pathname !== '/login-check' && (
        <>
          <Header />
          <Style.Spacing />
        </>
      )}
      {children}
    </div>
  );
};

export default Layout;
