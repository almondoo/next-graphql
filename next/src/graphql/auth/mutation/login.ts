import { gql } from '@apollo/client';

export const LOGIN_MUTATION = gql`
  mutation Login($input: LoginInput!) {
    login(input: $input) {
      name
      email
      access_token
      refresh_token
    }
  }
`;

export interface LoginData {
  name: string;
  email: string;
  access_token: string;
  refresh_token: string;
}
