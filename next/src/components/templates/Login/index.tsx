import { KeyboardEvent } from 'react';
import Avatar from '@mui/material/Avatar';
import Button from '@mui/material/Button';
import TextField from '@mui/material/TextField';
import FormControlLabel from '@mui/material/FormControlLabel';
import Checkbox from '@mui/material/Checkbox';
import { Link as MLink } from '@mui/material';
import Grid from '@mui/material/Grid';
import Box from '@mui/material/Box';
import LockOutlinedIcon from '@mui/icons-material/LockOutlined';
import Typography from '@mui/material/Typography';
import Container from '@mui/material/Container';
import CircularProgress from '@mui/material/CircularProgress';
import Copyright from 'components/uiParts/Copyright';
import Link from 'next/link';
import routes from 'utils/route';
import { useAuth0 } from '@auth0/auth0-react';
import { useMutation } from '@apollo/client';
import { LOGIN_MUTATION, LoginData } from 'graphql/auth/mutation/login';

const Login = (): JSX.Element => {
  const { loginWithRedirect } = useAuth0();
  const [login, { loading, data, error }] = useMutation<LoginData>(LOGIN_MUTATION);

  const handleSubmit = (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    const data = new FormData(event.currentTarget);
    login({
      variables: {
        input: {
          email: data.get('email'),
          password: data.get('password'),
        },
      },
    });
  };

  return (
    <Container component="main" maxWidth="xs" sx={{ marginTop: 8 }}>
      <Box
        sx={{
          display: 'flex',
          flexDirection: 'column',
          alignItems: 'center',
        }}
      >
        <Avatar sx={{ m: 1, bgcolor: 'secondary.main' }}>
          <LockOutlinedIcon />
        </Avatar>
        <Typography component="h1" variant="h5">
          ログイン
        </Typography>
        <Box component="form" onSubmit={handleSubmit} noValidate sx={{ mt: 1 }}>
          <TextField
            margin="normal"
            required
            fullWidth
            id="email"
            label="メールアドレス"
            name="email"
            onKeyPress={(e: KeyboardEvent<HTMLInputElement>) => {
              if (e.key === 'Enter') e.preventDefault();
            }}
            autoComplete="email"
            autoFocus
            // @ts-ignore
            error={error?.graphQLErrors[0].extensions.validation['input.email'] ? true : false}
            // @ts-ignore
            helperText={error?.graphQLErrors[0].extensions.validation['input.email']}
          />
          <TextField
            margin="normal"
            required
            fullWidth
            name="password"
            label="パスワード"
            type="password"
            id="password"
            autoComplete="current-password"
            // @ts-ignore
            error={error?.graphQLErrors[0].extensions.validation['input.password'] ? true : false}
            // @ts-ignore
            helperText={error?.graphQLErrors[0].extensions.validation['input.password']}
          />
          <FormControlLabel control={<Checkbox value="remember" color="primary" />} label="Remember me" />
          {!loading ? (
            <Button type="submit" fullWidth variant="contained" sx={{ mt: 3, mb: 2 }}>
              ログイン
            </Button>
          ) : (
            <Button variant="contained" fullWidth color="primary" sx={{ mt: 3, mb: 2 }}>
              <CircularProgress size={30} sx={{ color: 'white' }} />
            </Button>
          )}
        </Box>
        <Box mb={2} width="100%">
          <Button color="secondary" fullWidth variant="contained" onClick={() => loginWithRedirect()}>
            Auth0でログイン
          </Button>
        </Box>
        <Grid container>
          <Grid item xs>
            <Link href={routes.forgotPassword} passHref>
              <MLink variant="body2">パスワード忘れた？</MLink>
            </Link>
          </Grid>
          <Grid item>
            <Link href={routes.register} passHref>
              <MLink variant="body2">アカウントをお持ちではない方</MLink>
            </Link>
          </Grid>
        </Grid>
      </Box>

      <Copyright sx={{ mt: 8, mb: 4 }} />
    </Container>
  );
};

export default Login;
