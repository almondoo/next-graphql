import type { AppProps } from 'next/app';
import Layout from 'components/originals/Layout/index';
import theme from 'utils/theme';
import CssBaseline from '@mui/material/CssBaseline';
import { ThemeProvider } from '@mui/material/styles';
import { Auth0Provider } from '@auth0/auth0-react';
import { RecoilRoot } from 'recoil';
import { ApolloProvider } from '@apollo/client';
import client from 'graphql/apollo-client';

function MyApp({ Component, pageProps }: AppProps) {
  return (
    <ApolloProvider client={client}>
      <RecoilRoot>
        <Auth0Provider
          domain={process.env['NEXT_PUBLIC_AUTH0_DOMAIN'] ?? ''}
          clientId={process.env['NEXT_PUBLIC_AUTH0_CLIENT_ID'] ?? ''}
          redirectUri={process.env['NEXT_PUBLIC_AUTH0_REDIRECT_URL']}
        >
          <ThemeProvider theme={theme}>
            <CssBaseline />
            <Layout>
              <Component {...pageProps} />
            </Layout>
          </ThemeProvider>
        </Auth0Provider>
      </RecoilRoot>
    </ApolloProvider>
  );
}

export default MyApp;
